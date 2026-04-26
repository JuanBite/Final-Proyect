<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Enums\EnumStatus;
use Illuminate\Validation\Rules\Enum;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectMember;
use App\Models\ProjectTask;
use App\Models\Submission;

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

// ─── REEMPLAZA el método show() en ProjectController.php ───────────────────────

    public function show(Request $request, $id)
    {
        $project = \App\Models\Project::with(['leader', 'team'])->findOrFail($id);
        $users   = \App\Models\User::all();

        // ── Filtro año/mes ──────────────────────────────────────
        $filterYear  = (int) $request->get('filter_year',  now()->year);
        $filterMonth = (int) $request->get('filter_month', now()->month);

        // ── Tareas agrupadas por fase ───────────────────────────
        $tasks = \App\Models\ProjectTask::where('project_id', $project->id)
            ->orderBy('phase')
            ->orderBy('sort_order')
            ->get();

        // Agrupar por fase
        $phases = $tasks->groupBy('phase');

        // ── Entregas del mes filtrado, indexadas por [task_id][week] ──
        $submissionsMap = [];
        $allSubmissions = \App\Models\Submission::where('project_id', $project->id)
            ->where('submission_year',  $filterYear)
            ->where('submission_month', $filterMonth)
            ->get();

        foreach ($allSubmissions as $sub) {
            $submissionsMap[$sub->task_id][$sub->week_number][] = $sub;
        }

        return view('projects.details', compact(
            'project',
            'users',
            'phases',
            'filterYear',
            'filterMonth',
            'submissionsMap'
        ));
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
