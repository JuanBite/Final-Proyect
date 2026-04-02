<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
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

        return redirect('submissions')
            ->with('success', 'Entrega actualizada correctamente.');
    }

    // Eliminar
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect('submissions')
            ->with('success', 'Entrega eliminada correctamente.');
    }
}