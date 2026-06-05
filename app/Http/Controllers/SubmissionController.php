<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Services\GanttGradeService; // ← NUEVO: importar el service

class SubmissionController extends Controller
{
    // ← NUEVO: constructor que inyecta el service
    public function __construct(private GanttGradeService $gradeService) {}

    // List
    public function index() {
        $submissions = Submission::orderBy("submitted_at", "desc")->paginate(20);
        return view('submissions.index')->with('submissions', $submissions);
    }

    // Create
    public function create() {
        return view('modals.create.submission');
    }

    // Store
    public function store(Request $request){
        
        $request->validate([
            'project_id'   => ['required','exists:projects,id'],
            'file_path'    => ['nullable','string','max:255'],
            'comments'     => ['nullable','string'],
            'submitted_at' => ['required','date'],
            'grade'        => ['nullable','numeric'],
            'feedback'     => ['nullable','string'],
        ]);

        $submission = new Submission();

        $submission->project_id   = $request->project_id;
        $submission->file_path    = $request->file_path;
        $submission->comments     = $request->comments;
        $submission->submitted_at = $request->submitted_at;
        $submission->grade        = $request->grade;
        $submission->feedback     = $request->feedback;

        $submission->save();

        // ← NUEVO: recalcular progreso del proyecto al crear una entrega con nota
        if ($request->filled('grade')) {
            $this->gradeService->recalculateProject($submission->project);
        }

        return redirect('submissions')
            ->with('success', 'Entrega registrada correctamente.');
    }

    // Show
    public function show(Submission $submission)
    {
        return view('submissions.details')->with('submission', $submission);     
    }

    // Edit
    public function edit(Submission $submission)
    {
        return view('modals.edit.submission')->with('submission', $submission);
    }

    // Update
    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'project_id'   => ['required','exists:projects,id'],
            'file_path'    => ['nullable','string','max:255'],
            'comments'     => ['required','string'],
            'submitted_at' => ['required','date'],
            'grade'        => ['nullable','numeric'],
            'feedback'     => ['nullable','string'],
        ]);

        $submission->project_id   = $request->project_id;
        $submission->file_path    = $request->file_path;
        $submission->comments     = $request->comments;
        $submission->submitted_at = $request->submitted_at;
        $submission->grade        = $request->grade;
        $submission->feedback     = $request->feedback;

        $submission->save();

        // ← NUEVO: recalcular progreso del proyecto al actualizar (siempre,
        //   porque el instructor puede estar poniendo o quitando una nota)
        $this->gradeService->recalculateProject($submission->project);

        return redirect('submissions')
            ->with('success', 'Entrega actualizada correctamente.');
    }

    // Eliminar
    public function destroy(Submission $submission)
    {
        // ← NUEVO: guardar referencia al proyecto ANTES de borrar la submission
        $project = $submission->project;

        $submission->delete();

        // Recalcular porque al borrar una entrega cambia el peso de las demás
        if ($project) {
            $this->gradeService->recalculateProject($project);
        }

        return redirect('submissions')
            ->with('success', 'Entrega eliminada correctamente.');
    }
}