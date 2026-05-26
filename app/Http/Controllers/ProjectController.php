<?php

namespace App\Http\Controllers;

use App\Enums\EnumStatus;
use App\Models\Cohort;
use App\Models\Project;       // ← NUEVO
use App\Models\ProjectMember;
use App\Models\ProjectTask;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // ← NUEVO
        $query = Project::visibleTo($user); // ← NUEVO: era Project::query()

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $projects = $query->orderBy('id', 'desc')->paginate(9)->withQueryString();

        // ← NUEVO: usuarios acotados al scope del usuario autenticado
        $users = $user->role === 'ADMIN'
            ? User::all()
            : User::whereIn('center_id', $user->visibleCenterIds())->get();

        return view('projects.index', compact('projects', 'users'));
    }

    public function create()
    {
        $this->authorize('create', Project::class); // ← NUEVO

        $user = auth()->user(); // ← NUEVO
        // ← NUEVO: usuarios y fichas acotados al scope
        $users = $user->role === 'ADMIN'
    ? User::all()
    : User::whereIn('center_id', $user->visibleCenterIds())->get();
        $cohorts = $this->cohortsForUser($user); // ← NUEVO

        return view('modals.create.project', compact('users', 'cohorts')); // ← NUEVO: + cohorts
    }

    public function store(Request $request)
    {
        $this->authorize('create', Project::class); // ← NUEVO

        $user = auth()->user(); // ← NUEVO

        $validation = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:start_date'],
            // ← NUEVO: STUDENT usa su propia ficha y se autoasigna como líder
            'leader_id' => $user->isStudent() ? ['nullable'] : ['required', 'exists:users,id'],
            'team' => ['array'],
            // ← NUEVO: requerido para todos menos STUDENT
            'cohort_id' => ($user->isStudent() || $user->isAdmin())
                ? ['nullable', 'exists:cohorts,id']
                : ['required', 'exists:cohorts,id'],
        ]);

        $cohortId = $user->isStudent() ? $user->cohort_id : $request->cohort_id;
        $leaderId = $user->isStudent() ? $user->id : $request->leader_id;

        $centerId = null;
        if ($cohortId) {
            $cohort   = Cohort::findOrFail($cohortId);
            $centerId = $cohort->center_id;

            abort_unless(
                $user->isAdmin() || in_array($cohortId, $user->visibleCohortIds()),
                403,
                'No puedes crear proyectos en esta ficha.'
            );
        }

        DB::beginTransaction();

        try {
            $project = Project::create([
                'name'        => $request->name,
                'description' => $request->description,
                'start_date'  => $request->start_date,
                'due_date'    => $request->due_date,
                'leader_id'   => $leaderId,
                'cohort_id'   => $cohortId,  // null si ADMIN no eligió ficha
                'center_id'   => $centerId,  // null si ADMIN no eligió ficha
            ]);

            ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $leaderId,
                'project_role' => 'LEADER',
            ]);

            if ($request->team) {
                foreach ($request->team as $userId) {
                    if ($userId == $leaderId) {
                        continue;
                    }
                    ProjectMember::create([
                        'project_id' => $project->id,
                        'user_id' => $userId,
                        'project_role' => 'MEMBER',
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

    public function show(Request $request, $id)
    {
        $project = Project::with(['leader', 'team'])->findOrFail($id);

        $this->authorize('view', $project); // ← NUEVO

        $authUser = auth()->user();
    $users = $authUser->isAdmin()
        ? User::all()
        : User::whereIn('center_id', [$authUser->center_id])->get();

        $filterYear = (int) $request->get('filter_year', now()->year);
        $filterMonth = (int) $request->get('filter_month', now()->month);

        $tasks = ProjectTask::where('project_id', $project->id)
            ->orderBy('phase')
            ->orderBy('sort_order')
            ->get();

        $phases = $tasks->groupBy('phase');

        $submissionsMap = [];
        $allSubmissions = Submission::where('project_id', $project->id)
            ->where('submission_year', $filterYear)
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
        $this->authorize('update', $project); // ← NUEVO

        $user = auth()->user(); // ← NUEVO
        $users = $user->role === 'ADMIN'
            ? User::all()
            : User::whereIn('center_id', $user->visibleCenterIds())->get();
        $cohorts = $this->cohortsForUser($user); // ← NUEVO

        return view('modals.edit.project', compact('project', 'users', 'cohorts')); // ← NUEVO: + cohorts
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project); // ← NUEVO

        $user = auth()->user(); // ← NUEVO

        $rules = [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:start_date'],
            'leader_id' => $user->isStudent() ? ['nullable'] : ['required', 'exists:users,id'], // ← NUEVO
            'status' => ['required', new Enum(EnumStatus::class)],
            'team' => ['array'],
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            $updateData = [
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ];

            // ← NUEVO: STUDENT no puede cambiar el líder
            if (! $user->isStudent()) {
                $updateData['leader_id'] = $request->leader_id;
            }

            $project->update($updateData);

            ProjectMember::where('project_id', $project->id)->delete();

            $leaderId = $user->isStudent() ? $project->leader_id : $request->leader_id; // ← NUEVO

            ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $leaderId,
                'project_role' => 'LEADER',
            ]);

            if ($request->team) {
                foreach ($request->team as $userId) {
                    if ($userId == $leaderId) {
                        continue;
                    }
                    ProjectMember::create([
                        'project_id' => $project->id,
                        'user_id' => $userId,
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
        $this->authorize('delete', $project); // ← NUEVO

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado correctamente');
    }

    // ← NUEVO: helper privado reutilizado en create/edit
    private function cohortsForUser(\App\Models\User $user)
    {
        return match ($user->role) {
            'ADMIN' => Cohort::with('center')->get(),
            'REGIONAL_ADMIN' => Cohort::whereIn('center_id', $user->visibleCenterIds())->with('center')->get(),
            'COORDINATOR' => Cohort::where('center_id', $user->center_id)->get(),
            'STUDENT' => Cohort::where('id', $user->cohort_id)->get(),
            default => collect(),
        };
    }
    public function publicIndex()
    {
        $projects = Project::select('name', 'description')->orderBy('created_at', 'desc')->get();
        return view('projects.universal-search', compact('projects'));
    }
}
