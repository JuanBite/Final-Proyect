<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Enums\EnumStatus;
use Illuminate\Validation\Rules\Enum;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectMember; 

class ProjectController extends Controller
{
    //Listing

    public function index() {
        $projects = Project::orderBy('id', 'desc')->paginate(20);
        $users = User::all();

        return view('projects.index', compact('projects', 'users'));

        
    }

    //Create
    public function create() {
        $users = User::all(); 
        return view('modals.create.project');
    }

public function store(Request $request)
{
    $validation = $request->validate([
        'name'        => ['required','string'],
        'description' => ['required','string'],
        'start_date'  => ['required','date'],
        'due_date'    => ['required','date','after_or_equal:start_date'],
        'progress'    => ['required','numeric','min:0','max:100'],
        'leader_id'   => ['required','exists:users,id'],
        'status'      => ['required'],
        'team'        => ['array'] // 👈 importante
    ]);
    // dd($request->all());

    DB::beginTransaction();

    try {

        // 🔹 1. Crear proyecto
        $project = Project::create([
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'due_date'    => $request->due_date,
            'progress'    => $request->progress,
            'leader_id'   => $request->leader_id,
            'status'      => $request->status,
        ]);

        // 🔹 2. Guardar LÍDER en project_members
        ProjectMember::create([
            'project_id' => $project->id,
            'user_id'    => $request->leader_id,
            'project_role'       => 'LEADER' // 👈 enum
        ]);

        // 🔹 3. Guardar MIEMBROS
        if ($request->team) {
            foreach ($request->team as $userId) {

                // Evitar duplicar líder
                if ($userId == $request->leader_id) continue;

                ProjectMember::create([
                    'project_id' => $project->id,
                    'user_id'    => $userId,
                    'project_role'       => 'MEMBER'
                ]);
            }
        }

        DB::commit();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado correctamente');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->withErrors('Error al crear proyecto: ' . $e->getMessage());
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
        'leader_id'       => ['required', 'exists:users,id'],
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
