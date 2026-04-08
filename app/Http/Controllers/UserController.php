<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Cohort;
use App\Models\ProjectMember;
use App\Enums\RoleEnum;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    // LISTADO
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter'); // LEADER, MEMBER, o null (todos)

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
            ->get();

        $projects = Project::all();
        $cohorts  = Cohort::all();
        return view('users.index', compact('users', 'projects', 'cohorts'));
    }

    // CREAR
    public function create()
    {
        $projects = Project::all();
        return view('modals.create.user', compact('projects'));
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
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'document'   => $request->document,
            'password'   => bcrypt($request->password),
            'role'       => $request->role,
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
        $projects = Project::all();
        $cohorts  = Cohort::all();

        return view('users.detail', compact('user', 'projects', 'cohorts'));
    }

    // Edit
    public function edit(User $user)
    {
        $projects = Project::all();

        return view('modals.edit.user', compact('user', 'projects'));
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
        ]);

        // Contraseña (solo si viene)
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        // 🔥 AQUÍ ESTÁ LA CLAVE
        $user->projects()->sync($request->projects ?? []);


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
