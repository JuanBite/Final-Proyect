<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use App\Models\Region;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $authUser = auth()->user();
        $search   = $request->input('search');
        $filter   = $request->input('filter');
        $sort     = $request->input('sort', 'desc');
        $cohort   = $request->input('cohort');

        // ✅ IDs de fichas del instructor (desde pivot)
        $instructorCohortIds = $authUser->isInstructor()
            ? $authUser->cohorts()->pluck('cohorts.id')->toArray()
            : [];

        $users = User::with('projectMembers', 'cohort')
            ->when(
                ! $authUser->isAdmin(),
                fn($q) =>
                $q->whereIn('center_id', $authUser->visibleCenterIds())
            )
            ->when(
                $authUser->isInstructor(),
                fn($q) =>           // ✅ filtra por fichas del pivot
                $q->whereIn('cohort_id', $instructorCohortIds)
            )
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
            ->when($filter === 'LEADER', fn($q) => $q->whereHas('projectMembers', fn($q2) => $q2->where('project_role', 'LEADER')))
            ->when($filter === 'MEMBER', fn($q) => $q->whereHas('projectMembers', fn($q2) => $q2->where('project_role', 'MEMBER')))
            ->when($cohort, fn($q) => $q->where('cohort_id', $cohort))
            ->orderBy('created_at', $sort)
            ->paginate(10)
            ->withQueryString();

        $centerIds = $authUser->visibleCenterIds();

        $baseCount = fn() => User::when(
            ! $authUser->isAdmin(),
            fn($q) =>
            $q->whereIn('center_id', $centerIds)
        )
            ->when(
                $authUser->isInstructor(),
                fn($q) =>           // ✅ mismo filtro para los stats
                $q->whereIn('cohort_id', $instructorCohortIds)
            );

        $totalUsers   = $baseCount()->count();
        $totalLeaders = $baseCount()->whereHas('projectMembers', fn($q) => $q->where('project_role', 'LEADER'))->count();
        $totalMembers = $baseCount()->where('status', 1)->count();

        $projects = Project::visibleTo($authUser)->get();
        $cohorts  = $this->cohortsForUser($authUser);

        $regions = $authUser->isAdmin() ? Region::orderBy('name')->get() : collect();
        $centers = ($authUser->isAdmin() || $authUser->isRegionalAdmin())
            ? Center::with('region')
            ->when($authUser->isRegionalAdmin(), fn($q) => $q->where('region_id', $authUser->region_id))
            ->orderBy('name')->get()
            : collect();

        return view('users.index', compact(
            'users',
            'projects',
            'cohorts',
            'totalUsers',
            'totalLeaders',
            'totalMembers',
            'sort',
            'regions',
            'centers'
        ));
    }

    public function create()
    {
        $this->authorize('create', User::class); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO
        $projects = Project::visibleTo($authUser)->get(); // ← NUEVO: era Project::all()
        $cohorts = $this->cohortsForUser($authUser);     // ← NUEVO: era Cohort::all()


        $regions = $authUser->isAdmin() ? Region::orderBy('name')->get() : collect();
        $centers = ($authUser->isAdmin() || $authUser->isRegionalAdmin())
            ? Center::with('region')
            ->when($authUser->isRegionalAdmin(), fn($q) => $q->where('region_id', $authUser->region_id))
            ->orderBy('name')->get()
            : collect();

        return view('modals.create.user', compact('projects', 'cohorts', 'regions', 'centers'));
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
            'role' => ['required', 'in:' . $this->allowedRoles()],
            'cohort_id' => $authUser->isAdmin() ? ['nullable', 'exists:cohorts,id'] : ['nullable', 'exists:cohorts,id'],
            'center_id' => $request->role === 'REGIONAL_ADMIN'
                ? ['nullable']
                : ($authUser->isAdmin() ? ['nullable', 'exists:centers,id'] : ['nullable', 'exists:centers,id']),

            'region_id' => ($authUser->isAdmin() || $request->role === 'REGIONAL_ADMIN')
                ? ['nullable', 'exists:region,id']
                : ['nullable'],
        ]);

        // ← NUEVO: COORDINATOR solo asigna a su propio centro
        if ($authUser->isCoordinator()) {
            $request->merge(['center_id' => $authUser->center_id]);
        }
        if ($authUser->isCoordinator()) {
            $request->merge(['region_id' => $authUser->region_id]);
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

        if ($authUser->isRegionalAdmin()) {
            $request->merge(['region_id' => $authUser->region_id]);
        }

        // Para STUDENT tomamos el primer cohort_ids[] como cohort_id directo
        $cohortId = $request->cohort_id;
        if ($request->role === 'STUDENT' && $request->filled('cohort_ids')) {
            $cohortId = $request->cohort_ids[0];
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'document'   => $request->document,
            'password'   => bcrypt($request->password),
            'role'       => $request->role,
            'cohort_id'  => $cohortId,
            'center_id'  => $request->role === 'REGIONAL_ADMIN' ? null : $request->center_id,
            'region_id'  => $request->region_id,
        ]);

        if ($user->role === 'INSTRUCTOR' && $request->filled('cohort_ids')) {
            $user->cohorts()->sync($request->cohort_ids);
        }
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
            fn($p) => $p->pivot->project_role === 'LEADER'
        );

        $teammates = $assignedProjects
            ->flatMap(fn($p) => $p->members)
            ->filter(fn($m) => $m->id !== $user->id)
            ->unique('id');

        $authUser = auth()->user(); // ← NUEVO
        $projects = Project::visibleTo($authUser)->get(); // ← NUEVO: era Project::all()
        $cohorts = $this->cohortsForUser($authUser);     // ← NUEVO: era Cohort::all()

        return view('users.detail', compact(
            'user',
            'projects',
            'cohorts',
            'assignedProjects',
            'ledProjects',
            'teammates'
        ));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $authUser = auth()->user();
        $projects = Project::visibleTo($authUser)->get();
        $cohorts  = $this->cohortsForUser($authUser);

        $regions = $authUser->isAdmin() ? Region::orderBy('name')->get() : collect();
        $centers = ($authUser->isAdmin() || $authUser->isRegionalAdmin())
            ? Center::with('region')
            ->when($authUser->isRegionalAdmin(), fn($q) => $q->where('region_id', $authUser->region_id))
            ->orderBy('name')->get()
            : collect();

        return view('modals.edit.user', compact('user', 'projects', 'cohorts', 'regions', 'centers'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user); // ← NUEVO

        $authUser = auth()->user(); // ← NUEVO


        $cohortId = $request->cohort_id;
        if ($request->role === 'STUDENT' && $request->filled('cohort_ids')) {
            $cohortId = $request->cohort_ids[0];
        }
        if ($request->role === 'INSTRUCTOR') {
            $cohortId = null;
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'document'   => $request->document,
            'email'      => $request->email,
            'role'       => $request->role,
            'status'     => $request->status,
            'cohort_id'  => $cohortId,
            'center_id'  => ($request->role === 'REGIONAL_ADMIN' || !$request->center_id)
                ? null
                : ($authUser->isCoordinator() || $authUser->isRegionalAdmin()
                    ? $user->center_id
                    : $request->center_id),
            'region_id'  => $request->region_id ?: null, // también sanitizar region_id
        ]);

        if ($request->role === 'INSTRUCTOR') {
            $user->cohorts()->sync($request->filled('cohort_ids') ? $request->cohort_ids : []);
        } else {

            $user->cohorts()->detach();
        }

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }


        $allowedProjectIds = Project::visibleTo($authUser)->pluck('id')->toArray();
        $projectsToSync = collect($request->projects ?? [])
            ->filter(fn($pid) => in_array($pid, $allowedProjectIds))
            ->toArray();

        $user->projects()->sync($projectsToSync);

        if ($request->redirect_to === 'show') {
            return redirect()->route('users.show', $user->id)
                ->with('success', 'Usuario actualizado correctamente');
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado');
    }



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
