<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $authUser = auth()->user();
        $search = $request->input('search');
        $filter = $request->input('filter');
        $sort = $request->input('sort', 'desc');
        $cohort = $request->input('cohort');

        $users = User::with('projectMembers', 'cohort')
            ->when(! $authUser->isAdmin(), fn ($q) => $q->whereIn('center_id', $authUser->visibleCenterIds()))
            ->when($authUser->isInstructor(), fn ($q) => $q->where('cohort_id', $authUser->cohort_id))
            ->when($search, function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('document', 'like', "%$search%")
                    ->orWhereHas('cohort', function ($q) use ($search) {
                        $q->where('program_name', 'like', "%$search%")
                            ->orWhere('cohort_number', 'like', "%$search%");
                    });
            })
            ->when($filter === 'LEADER', fn ($q) => $q->whereHas('projectMembers', fn ($q2) => $q2->where('project_role', 'LEADER')))
            ->when($filter === 'MEMBER', fn ($q) => $q->whereHas('projectMembers', fn ($q2) => $q2->where('project_role', 'MEMBER')))
            ->when($cohort, fn ($q) => $q->where('cohort_id', $cohort))
            ->orderBy('created_at', $sort)
            ->paginate(10)
            ->withQueryString();

        $centerIds = $authUser->visibleCenterIds();
        $baseCount = fn () => User::when(! $authUser->isAdmin(), fn ($q) => $q->whereIn('center_id', $centerIds))
            ->when($authUser->isInstructor(), fn ($q) => $q->where('cohort_id', $authUser->cohort_id));

        $totalUsers = $baseCount()->count();
        $totalLeaders = $baseCount()->whereHas('projectMembers', fn ($q) => $q->where('project_role', 'LEADER'))->count();
        $totalMembers = $baseCount()->where('status', 1)->count();

        $projects = Project::visibleTo($authUser)->get();
        $cohorts = $this->cohortsForUser($authUser);

        return view('users.index', compact(
            'users',
            'projects',
            'cohorts',
            'totalUsers',
            'totalLeaders',
            'totalMembers',
            'sort'
        ));
    }

    public function create()
    {
        $this->authorize('create', User::class); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO
        $projects = Project::visibleTo($authUser)->get(); // ← NUEVO: era Project::all()
        $cohorts = $this->cohortsForUser($authUser);     // ← NUEVO: era Cohort::all()

        return view('modals.create.user', compact('projects', 'cohorts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO

        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'document' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
            // ← NUEVO: solo los roles que este usuario puede crear
            'role' => ['required', 'in:'.$this->allowedRoles()],
            'center_id' => ['nullable', 'exists:centers,id'],
        ]);

        // ← NUEVO: COORDINATOR solo asigna a su propio centro
        if ($authUser->isCoordinator()) {
            $request->merge(['center_id' => $authUser->center_id]);
        }

        // ← NUEVO: REGIONAL_ADMIN no puede asignar a centros fuera de su regional
        if ($authUser->isRegionalAdmin() && $request->center_id) {
            abort_unless(
                in_array($request->center_id, $authUser->visibleCenterIds()),
                403,
                'No puedes crear usuarios en ese centro.'
            );
        }

        // Validación original de COORDINATOR (reemplazada por la de arriba, se mantiene como fallback)
        if (
            Auth::user()->role === 'COORDINATOR' &&
            $request->center_id != Auth::user()->center_id
        ) {
            return redirect()->back()->withErrors([
                'center_id' => 'Los coordinadores solo pueden asignar usuarios a su propio centro.',
            ]);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'document' => $request->document,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'cohort_id' => $request->cohort_id,
            'center_id' => $request->center_id,
        ]);

        if ($request->projects) {
            foreach ($request->projects as $projectId) {
                // ← NUEVO: verificar que el proyecto esté en el scope antes de asignar
                $project = Project::find($projectId);
                if (! $project || ! in_array($project->center_id, $authUser->visibleCenterIds())) {
                    continue; // saltar proyectos fuera de scope
                }

                ProjectMember::create([
                    'user_id' => $user->id,
                    'project_id' => $projectId,
                    'project_role' => $request->role === 'INSTRUCTOR' ? 'LEADER' : 'MEMBER',
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user); // ← NUEVO

        $user->load(['projects.members', 'projectMembers']);

        $assignedProjects = $user->projects;

        $ledProjects = $assignedProjects->filter(
            fn ($p) => $p->pivot->project_role === 'LEADER'
        );

        $teammates = $assignedProjects
            ->flatMap(fn ($p) => $p->members)
            ->filter(fn ($m) => $m->id !== $user->id)
            ->unique('id');

        $authUser = auth()->user(); // ← NUEVO
        $projects = Project::visibleTo($authUser)->get(); // ← NUEVO: era Project::all()
        $cohorts = $this->cohortsForUser($authUser);     // ← NUEVO: era Cohort::all()

        return view('users.detail', compact(
            'user', 'projects', 'cohorts',
            'assignedProjects', 'ledProjects', 'teammates'
        ));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO
        $projects = Project::visibleTo($authUser)->get(); // ← NUEVO
        $cohorts = $this->cohortsForUser($authUser);     // ← NUEVO

        return view('modals.edit.user', compact('user', 'projects', 'cohorts'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'cohort_id' => $request->cohort_id,
            // ← NUEVO: COORDINATOR no puede reasignar centro
            'center_id' => $authUser->isCoordinator() ? $user->center_id : $request->center_id,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        // ← NUEVO: filtrar proyectos fuera del scope antes de sincronizar
        $allowedProjectIds = Project::visibleTo($authUser)->pluck('id')->toArray();
        $projectsToSync = collect($request->projects ?? [])
            ->filter(fn ($pid) => in_array($pid, $allowedProjectIds))
            ->toArray();

        $user->projects()->sync($projectsToSync); // era: sync($request->projects ?? [])

        if ($request->redirect_to === 'show') {
            return redirect()->route('users.show', $user->id)
                ->with('success', 'Usuario actualizado correctamente');
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user); // ← NUEVO

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado');
    }

    // ← NUEVO: helpers privados ────────────────────────────────────────────────

    private function cohortsForUser(User $authUser)
    {
        return match ($authUser->role) {
            'ADMIN' => Cohort::with('center')->get(),
            'REGIONAL_ADMIN' => Cohort::whereIn('center_id', $authUser->visibleCenterIds())->with('center')->get(),
            'COORDINATOR' => Cohort::where('center_id', $authUser->center_id)->get(),
            default => Cohort::where('id', $authUser->cohort_id)->get(),
        };
    }

    private function allowedRoles(): string
    {
        return implode(',', match (auth()->user()->role) {
            'ADMIN' => ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR', 'STUDENT'],
            'REGIONAL_ADMIN' => ['COORDINATOR', 'INSTRUCTOR', 'STUDENT'],
            'COORDINATOR' => ['INSTRUCTOR', 'STUDENT'],
            default => [],
        });
    }
}
