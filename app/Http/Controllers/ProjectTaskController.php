<?php

namespace App\Http\Controllers;

use App\Enums\TaskEnum;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use App\Notifications\EntregaSubidaNotification;
use App\Notifications\EntregaCalificadaNotification;
use App\Services\GanttGradeService; // ← NUEVO

class ProjectTaskController extends Controller
{
    // ← NUEVO: constructor que inyecta el service
    public function __construct(private GanttGradeService $gradeService) {}

    public function store(Request $request, Project $project)
    {
        abort_unless(
            auth()->user()->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'STUDENT']),
            403,
            'Solo los APRENDICES pueden crear actividades.'
        );
        $this->authorize('update', $project);

        $request->validate([
            'phase'       => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['nullable', 'date'],
            'due_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['required', new Enum(TaskEnum::class)],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $sortOrder = ProjectTask::where('project_id', $project->id)
            ->where('phase', $request->phase)
            ->max('sort_order') + 1;

        ProjectTask::create([
            'project_id'  => $project->id,
            'phase'       => strtoupper(trim($request->phase)),
            'sort_order'  => $sortOrder,
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'due_date'    => $request->due_date,
            'status'      => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Actividad "' . $request->title . '" añadida al cronograma.');
    }

    public function update(Request $request, Project $project, ProjectTask $task)
    {
        abort_unless(
            auth()->user()->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR', 'STUDENT']),
            403,
            'Solo los coordinadores pueden editar actividades.'
        );
        $this->authorize('update', $project);

        $request->validate([
            'phase'       => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['nullable', 'date'],
            'due_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['required', new Enum(TaskEnum::class)],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $task->update([
            'phase'       => strtoupper(trim($request->phase)),
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'due_date'    => $request->due_date,
            'status'      => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Project $project, ProjectTask $task)
    {
        abort_unless(
            auth()->user()->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'STUDENT']),
            403,
            'Solo los coordinadores pueden eliminar actividades.'
        );
        $this->authorize('delete', $project);

        foreach ($task->submissions as $sub) {
            if ($sub->file_path) {
                Storage::disk('public')->delete($sub->file_path);
                $this->pruneEmptyDirectories(dirname($sub->file_path));
            }
        }

        $task->delete();

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Actividad eliminada.');
    }

    public function storeSubmission(Request $request, Project $project, ProjectTask $task)
    {
        $user = auth()->user();

        abort_unless(
            $user->isStudent() || $user->isAdmin() || $user->isInstructor(),
            403,
            'Solo los aprendices o instructores pueden subir entregas.'
        );

        if ($user->isStudent()) {
            abort_unless(
                $project->cohort_id === $user->cohort_id,
                403,
                'No perteneces a la ficha de este proyecto.'
            );
        }

        if ($user->isInstructor()) {
            abort_unless(
                $user->cohorts()->where('cohorts.id', $project->cohort_id)->exists(),
                403,
                'No tienes asignada la ficha de este proyecto.'
            );
        }

        $request->validate([
            'file'         => ['required', 'file', 'max:20480'],
            'comments'     => ['nullable', 'string'],
            'week_number'  => ['required', 'integer', 'between:1,4'],
            'filter_year'  => ['required', 'integer'],
            'filter_month' => ['required', 'integer', 'between:1,12'],
        ]);

        $file          = $request->file('file');
        $month         = $request->filter_month;
        $week          = $request->week_number;
        $year          = $request->filter_year;
        $projectSlug   = Str::slug($project->name, '-') . '-' . $project->id;
        $monthAbbr     = $this->monthAbbr($month);
        $submissionDir = "{$monthAbbr}-s{$week}-{$year}";
        $storagePath   = "submissions/{$projectSlug}/{$submissionDir}";
        $path          = $file->store($storagePath, 'public');

        $submission = Submission::create([
            'project_id'        => $project->id,
            'task_id'           => $task->id,
            'file_path'         => $path,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type'         => $file->getMimeType(),
            'comments'          => $request->comments,
            'submitted_at'      => now(),
            'week_number'       => $week,
            'submission_month'  => $month,
            'submission_year'   => $year,
        ]);

        // Autocalificar si es instructor
        if ($user->isInstructor()) {
            $submission->update([
                'grade'    => 100.00,
                'feedback' => 'Calificado automáticamente por el instructor.',
            ]);
        }

        // ← Recalcular siempre: una entrega nueva (con o sin nota)
        //   convierte la semana de "vacía" a "pendiente=0" o "calificada"
        $this->gradeService->recalculateProject($project);

        $instructores = $project->cohort->instructors;
        foreach ($instructores as $instructor) {
            $instructor->notify(new EntregaSubidaNotification($submission, $project, $task));
        }

        return redirect()->route('projects.show', [
            'project'      => $project->id,
            'filter_year'  => $year,
            'filter_month' => $month,
        ])->with('success', 'Entrega subida correctamente.');
    }

    public function destroySubmission(Project $project, ProjectTask $task, Submission $submission)
    {
        $user = auth()->user();

        $canDelete = $user->isAdmin()
            || ($user->isRegionalAdmin() && in_array($project->center_id, $user->visibleCenterIds()))
            || ($user->isCoordinator() && $project->center_id === $user->center_id)
            || ($user->isInstructor() && $user->cohorts()->where('cohorts.id', $project->cohort_id)->exists())
            || ($user->isStudent() && $project->cohort_id === $user->cohort_id);

        abort_unless($canDelete, 403, 'No puedes eliminar esta entrega.');

        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);
            $this->pruneEmptyDirectories(dirname($submission->file_path));
        }

        $submission->delete();

        // ← NUEVO: recalcular porque al borrar una entrega calificada cambia el promedio
        $this->gradeService->recalculateProject($project);

        return back()->with('success', 'Entrega eliminada.');
    }

    public function gradeSubmission(Request $request, Project $project, ProjectTask $task, Submission $submission)
    {
        $request->validate([
            'grade'    => ['required', 'numeric', 'min:0', 'max:100'],
            'feedback' => ['nullable', 'string', 'max:500'],
        ]);

        $submission->update([
            'grade'    => $request->grade,
            'feedback' => $request->feedback,
        ]);

        // ← NUEVO: recalcular porque el instructor acaba de poner una nota
        $this->gradeService->recalculateProject($project);

        $submission->load(['task.project']);

        $estudiantes = \App\Models\User::where('cohort_id', $project->cohort_id)
            ->where('role', 'STUDENT')
            ->get();

        foreach ($estudiantes as $estudiante) {
            $estudiante->notify(new EntregaCalificadaNotification($submission, $project, $task));
        }

        return back()->with('success', 'Entrega calificada correctamente.');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function pruneEmptyDirectories(string $dir): void
    {
        if ($dir === 'submissions' || $dir === '.' || $dir === '') {
            return;
        }

        $disk = Storage::disk('public');
        if (empty($disk->files($dir)) && empty($disk->directories($dir))) {
            $disk->deleteDirectory($dir);
            $this->pruneEmptyDirectories(dirname($dir));
        }
    }

    private function monthAbbr(int $month): string
    {
        return match ($month) {
            1  => 'ene',
            2  => 'feb',
            3  => 'mar',
            4  => 'abr',
            5  => 'may',
            6  => 'jun',
            7  => 'jul',
            8  => 'ago',
            9  => 'sep',
            10 => 'oct',
            11 => 'nov',
            12 => 'dic',
        };
    }

    public function downloadSubmission(Project $project, ProjectTask $task, Submission $submission)
    {
        $user = auth()->user();

        $canDownload = $user->isAdmin()
            || ($user->isRegionalAdmin() && in_array($project->center_id, $user->visibleCenterIds()))
            || ($user->isCoordinator() && $project->center_id === $user->center_id)
            || ($user->isInstructor() && $user->cohorts()->where('cohorts.id', $project->cohort_id)->exists())
            || ($user->isStudent() && $project->cohort_id === $user->cohort_id);

        abort_unless($canDownload, 403, 'No puedes descargar esta entrega.');
        abort_unless(Storage::disk('public')->exists($submission->file_path), 404, 'Archivo no encontrado.');

        return Storage::disk('public')->download(
            $submission->file_path,
            $submission->original_filename
        );
    }
}