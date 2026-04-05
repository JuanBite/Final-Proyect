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
    public function index()
    {
        $users = User::with(['projects', 'projectMembers.project'])
            ->orderBy('id', 'desc')
            ->paginate(20);

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
            'password'   => ['required', 'confirmed'],
            'role'       => ['required', new Enum(RoleEnum::class)],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
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

    // DETALLE
    public function show(User $user)
    {
        $projects = Project::all();
        $cohorts  = Cohort::all();

        return view('users.detail', compact('user', 'projects', 'cohorts'));
    }

    // EDITAR
    public function edit(User $user)
    {
        $projects = Project::all();
        return view('modals.edit.user', compact('user', 'projects'));
    }

    // ACTUALIZAR
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'email'      => ['required', 'email', 'unique:users,email,' . $user->id],
            'role'       => ['required', new Enum(RoleEnum::class)],
        ]);

        $user->update($validated);

        // Reset proyectos
        ProjectMember::where('user_id', $user->id)->delete();

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