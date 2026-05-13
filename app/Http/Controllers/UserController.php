<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Cohort;
use App\Models\ProjectMember;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    // LISTADO
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $sort   = $request->input('sort', 'desc');
        $cohort = $request->input('cohort'); // nuevo

        $users = User::with('projectMembers', 'cohort')
            ->when($search, function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name',  'like', "%$search%")
                    ->orWhere('email',      'like', "%$search%")
                    ->orWhere('document',   'like', "%$search%");
            })
            ->when($filter === 'LEADER', function ($query) {
                $query->whereHas('projectMembers', fn($q) => $q->where('project_role', 'LEADER'));
            })
            ->when($filter === 'MEMBER', function ($query) {
                $query->whereHas('projectMembers', fn($q) => $q->where('project_role', 'MEMBER'));
            })
            ->when($cohort, function ($query) use ($cohort) {
                $query->where('cohort_id', $cohort);
            })
            ->orderBy('created_at', $sort)
            ->paginate(10)
            ->withQueryString();

        $totalUsers   = User::count();
        $totalLeaders = User::whereHas('projectMembers', fn($q) => $q->where('project_role', 'LEADER'))->count();
        $totalMembers = User::where('status', 1)->count();

        $projects = Project::all();
        $cohorts  = Cohort::all();

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

    // CREAR
    public function create()
    {
        $projects = Project::all();
        $cohorts = Cohort::all();
        return view('modals.create.user', compact('projects', 'cohorts'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'document'   => ['required', 'string'],
            'password'   => ['required', 'confirmed'],
            'role'       => ['required', new Enum(RoleEnum::class)],
            'center_id'  => ['nullable', 'exists:centers,id'],
        ]);

        if (
            Auth::user()->role === 'COORDINATOR' &&
            $request->center_id != Auth::user()->center_id
        ) {
            return redirect()->back()->withErrors([
                'center_id' => 'Los coordinadores solo pueden asignar usuarios a su propio centro.'
            ]);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'document'   => $request->document,
            'password'   => bcrypt($request->password),
            'role'       => $request->role,
            'cohort_id'  => $request->cohort_id,
            'center_id'  => $request->center_id,
        ]);

        // Proyectos
        if ($request->projects) {
            foreach ($request->projects as $projectId) {
                ProjectMember::create([
                    'user_id'      => $user->id,
                    'project_id'   => $projectId,
                    'project_role' => $request->role === 'INSTRUCTOR' ? 'LEADER' : 'MEMBER',
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    // Show
    public function show(User $user)
    {
        $user->load(['projects.members', 'projectMembers']);

        $assignedProjects = $user->projects;

        $ledProjects = $assignedProjects->filter(
            fn($p) => $p->pivot->project_role === 'LEADER'
        );

        // members() ya retorna Users directamente
        $teammates = $assignedProjects
            ->flatMap(fn($p) => $p->members)
            ->filter(fn($m) => $m->id !== $user->id) // $m es User, no ProjectMember
            ->unique('id');

        $projects = Project::all();
        $cohorts  = Cohort::all();

        return view('users.detail', compact(
            'user',
            'projects',
            'cohorts',
            'assignedProjects',
            'ledProjects',
            'teammates'
        ));
    }

    // Edit
    public function edit(User $user)
    {
        $projects = Project::all();
        $cohorts = Cohort::all();

        return view('modals.edit.user', compact('user', 'projects', 'cohorts'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Actualizar datos básicos
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'cohort_id'  => $request->cohort_id,
        ]);

        // Contraseña (solo si viene)
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        // 🔥 AQUÍ ESTÁ LA CLAVE
        $user->projects()->sync($request->projects ?? []);


        // 🔥 Redirige según desde dónde vino
        if ($request->redirect_to === 'show') {
            return redirect()->route('users.show', $user->id)
                ->with('success', 'Usuario actualizado correctamente');
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    // ELIMINAR
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado');
    }
}
