<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\EnumStatus;
use App\Models\Project;
use Illuminate\Validation\Rules\Enum;

class ProjectController extends Controller
{
    //Listing
    public function index() {
        $projects = User::orderBy("name")->paginate(20);
        return view('projects.index')->with('projects', $projects);
    }

    //Create
    public function create() {
        return view('modals.create.project');
    }

    public function store(Request $request){
    
    $validation= $request->validate([
        'name'            => ['required','string'],
        'descripcion'     => ['required','string'],
        'start_date'      => ['required','date'],
        'due_date'        => ['required', 'date', 'after_or_equal:start_date'],
        'progress'        => ['required','numeric', 'decimal:0,100'],
        'leader_id'       => ['nullable', 'exist:users,id'],
        'status'          => ['required', new Enum(EnumStatus::class)],

    ]);

    $project = new Project();
    $project->name        = $request    ->name;
    $project->descripcion = $request    ->descripcion;
    $project->start_date  = $request    ->start_date;
    $project->due_date    = $request    ->due_date;
    $project->progress    = $request    ->progress;
    $project->leader_id   = $request    ->leader_id;
    $project->status      = $request    ->bolean('status');

    if ($project->save()) {
            return redirect('projects')->with('success', 'Project ' . $project->name . ' was successfully added.');

    }
}

public function show(Project $Project)
    {
        return view('projects.details')->with('projects', $Project);
    }

     public function edit(Project $Project)
    {
        return view('modals.edit.project')->with('projects', $Project);
    }

    public function update(Request $request, Project $Project)
    {
        $validation= $request->validate([
        'name'            => ['required','string'],
        'descripcion'     => ['required','string'],
        'start_date'      => ['required','date'],
        'due_date'        => ['required', 'date', 'after_or_equal:start_date'],
        'progress'        => ['required','numeric', 'decimal:0,100'],
        'leader_id'       => ['nullable', 'exist:users,id'],
        'status'          => ['required', new Enum(EnumStatus::class)],

    ]);

        $validation['status'] = $request->boolean('status');

        $Project->update($validation);

        return redirect('Projects')
            ->with('success', 'Projects '  . $Project->name . ' was successfully updated.');
    }

     public function destroy(Project $Project)
    {
        if ($Project->delete()) {
            return redirect('Projects')->with('success', 'Projects ' . $Project->name . ' was successfully deleted.');
        }
    }
}
