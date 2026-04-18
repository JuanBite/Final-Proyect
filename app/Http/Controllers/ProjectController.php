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

    public function index(Request $request)
    {
        $query = Project::query();

        //  BUSCADOR
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $projects = $query->orderBy('id', 'desc')->paginate(9)->withQueryString();
        $users = User::all();

        return view('projects.index', compact('projects', 'users'));
    }

    //Create
    public function create()
    {
        $users = User::all();
        return view('modals.create.project', compact('users'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'        => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date'  => ['required', 'date'],
            'due_date'    => ['required', 'date', 'after_or_equal:start_date'],
            'progress'    => ['required', 'numeric', 'min:0', 'max:100'],
            'leader_id'   => ['required', 'exists:users,id'],
            'status'      => ['required'],
            'team'        => ['array']
        ]);
        // dd($request->all());

        DB::beginTransaction();

        try {


            $project = Project::create([
                'name'        => $request->name,
                'description' => $request->description,
                'start_date'  => $request->start_date,
                'due_date'    => $request->due_date,
                'progress'    => $request->progress,
                'leader_id'   => $request->leader_id,
                'status'      => $request->status,
            ]);


            ProjectMember::create([
                'project_id' => $project->id,
                'user_id'    => $request->leader_id,
                'project_role'       => 'LEADER'
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

    public function show($id)
    {
        $project = \App\Models\Project::with(['leader', 'team'])->findOrFail($id);
        $users = User::all();
        return view('projects.details', compact('project', 'users'));
    }


    public function edit(Project $project)
    {
        $users = User::all();
        return view('modals.edit.project', compact('project', 'users'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date'  => ['required', 'date'],
            'due_date'    => ['required', 'date', 'after_or_equal:start_date'],
            'progress'    => ['required', 'numeric', 'min:0', 'max:100'],
            'leader_id'   => ['required', 'exists:users,id'],
            'status'      => ['required', new Enum(EnumStatus::class)],
            'team'        => ['array'],
        ]);

        DB::beginTransaction();

        try {
            $project->update([
                'name'        => $request->name,
                'description' => $request->description,
                'start_date'  => $request->start_date,
                'due_date'    => $request->due_date,
                'progress'    => $request->progress,
                'leader_id'   => $request->leader_id,
                'status'      => $request->status,
            ]);


            ProjectMember::where('project_id', $project->id)->delete();


            ProjectMember::create([
                'project_id'   => $project->id,
                'user_id'      => $request->leader_id,
                'project_role' => 'LEADER',
            ]);

            // Reinsertar miembros del equipo
            if ($request->team) {
                foreach ($request->team as $userId) {
                    if ($userId == $request->leader_id) continue;

                    ProjectMember::create([
                        'project_id'   => $project->id,
                        'user_id'      => $userId,
                        'project_role' => 'MEMBER',
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('projects.show', $project->id)
                ->with('success', 'Proyecto actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado correctamente');
    }
}
