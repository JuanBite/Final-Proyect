<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\Project;
use App\Models\Submission;
use App\Enums\TaskEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectTaskController extends Controller
{
    // ── Store nueva tarea ────────────────────────────────────────

    public function store(Request $request, Project $project)
    {
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

    // ── Update tarea ────────────────────────────────────────────

    public function update(Request $request, Project $project, ProjectTask $task)
    {
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

    // ── Destroy tarea ───────────────────────────────────────────

    public function destroy(Project $project, ProjectTask $task)
    {
        foreach ($task->submissions as $sub) {
            if ($sub->file_path) {
                Storage::disk('public')->delete($sub->file_path);
                // Limpiar carpeta de semana y carpeta de tarea si quedan vacías
                $this->pruneEmptyDirectories(dirname($sub->file_path));
            }
        }

        $task->delete();

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Actividad eliminada.');
    }

    // ── Store entrega (archivo) desde celda de semana ────────────

    public function storeSubmission(Request $request, Project $project, ProjectTask $task)
    {
        $request->validate([
            'file'         => ['required', 'file', 'max:20480'],
            'comments'     => ['nullable', 'string'],
            'week_number'  => ['required', 'integer', 'between:1,4'],
            'filter_year'  => ['required', 'integer'],
            'filter_month' => ['required', 'integer', 'between:1,12'],
        ]);

        $file  = $request->file('file');
        $month = $request->filter_month;
        $week  = $request->week_number;
        $year  = $request->filter_year;

        // ── Nombre de carpeta del proyecto: slug-id  ej: sigpro-3
        $projectSlug   = Str::slug($project->name, '-') . '-' . $project->id;

        // ── Nombre de carpeta de la entrega: mes-semana  ej: feb-s2
        $monthAbbr     = $this->monthAbbr($month);
        $submissionDir = "{$monthAbbr}-s{$week}-{$year}";

        // ── Ruta final: submissions/sigpro-3/feb-s2-2025/archivo.pdf
        $storagePath = "submissions/{$projectSlug}/{$submissionDir}";

        $path = $file->store($storagePath, 'public');

        Submission::create([
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

        return redirect()->route('projects.show', [
            'project'      => $project->id,
            'filter_year'  => $year,
            'filter_month' => $month,
        ])->with('success', 'Entrega subida correctamente.');
    }

    // ── Destroy entrega ─────────────────────────────────────────

    public function destroySubmission(Project $project, ProjectTask $task, Submission $submission)
    {
        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);

            // Intentar eliminar carpeta de semana y luego la del proyecto si quedan vacías
            $this->pruneEmptyDirectories(dirname($submission->file_path));
        }

        $submission->delete();

        return back()->with('success', 'Entrega eliminada.');
    }

    // ── Helpers ─────────────────────────────────────────────────

    /**
     * Sube por el árbol de directorios eliminando carpetas vacías.
     * Se detiene en "submissions/" para no borrar la raíz.
     */
    private function pruneEmptyDirectories(string $dir): void
    {
        // No subir más allá de la carpeta raíz de submissions
        if ($dir === 'submissions' || $dir === '.' || $dir === '') {
            return;
        }

        $disk  = Storage::disk('public');
        $files = $disk->files($dir);
        $dirs  = $disk->directories($dir);

        if (empty($files) && empty($dirs)) {
            $disk->deleteDirectory($dir);
            // Subir al padre recursivamente
            $this->pruneEmptyDirectories(dirname($dir));
        }
    }

    /**
     * Devuelve la abreviatura del mes en español (3 letras).
     */
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


    public function gradeSubmission(Request $request, Project $project, ProjectTask $task, Submission $submission)
{
    // Solo admin e instructor pueden calificar
    abort_unless(in_array(auth()->user()->role, ['ADMIN', 'INSTRUCTOR']), 403);

    $request->validate([
        'grade'    => ['required', 'numeric', 'min:0', 'max:100'],
        'feedback' => ['nullable', 'string', 'max:500'],
    ]);

    $submission->update([
        'grade'    => $request->grade,
        'feedback' => $request->feedback,
    ]);

    return back()->with('success', 'Entrega calificada correctamente.');
}
}