<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Validation\Rules\Enum;


class UserController extends Controller
{
    // Listing
    public function index()
{
 $users = User::with('projects')->get();

    $users    = User::with(['projects', 'projectMembers', 'projectMembers.project'])->orderBy('id', 'desc')->paginate(20);
    $projects = \App\Models\Project::all();
    $cohorts  = \App\Models\Cohort::all();

    return view('users.index', compact('users', 'projects', 'cohorts'));
}

    // Create
    public function create()
    {
        return view('modals.create.user');
    }
    // Store
    public function store(Request $request)
{
    $request->validate([
    
        'first_name' => ['required', 'string'],
        'last_name'  => ['required', 'string'],
        'email'      => ['required', 'lowercase', 'email', 'unique:' . User::class],
        'password'   => ['required', 'confirmed'],
        'role'       => ['required', new Enum(RoleEnum::class)],
       

    ]);

    
    
    $user = new User();
    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->email      = $request->email;
    $user->password   = bcrypt($request->password);
    $user->role       = $request->role;


    if ($user->save()) {

    
        // Asignar proyectos
        if ($request->has('projects')) {
            foreach ($request->projects as $projectId) {
                \App\Models\ProjectMember::create([
                    'user_id'      => $user->id,
                    'project_id'   => $projectId,
                    'project_role' => $request->role === 'INSTRUCTOR' ? 'LEADER' : 'MEMBER',
                ]);
            }
        }

       

        return redirect('users')->with('success', 'Usuario ' . $user->first_name . ' ' . $user->last_name . ' creado correctamente.');
    }
}
    // Show
    public function show(User $user)
    {
        return view('users.detail')->with('user', $user);
    }
    // Edit
    public function edit(User $user)
    {
        return view('modals.edit.user')->with('user', $user);
    }
    // Update
  public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'first_name' => ['required', 'string'],
        'last_name'  => ['required', 'string'],
        'email'      => ['required', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $user->id],
        'role'       => ['required', new Enum(RoleEnum::class)],
    ]);

    $user->update($validated);

    // Sincronizar proyectos
    \App\Models\ProjectMember::where('user_id', $user->id)->delete();

    if ($request->has('projects')) {
        foreach ($request->projects as $projectId) {
            \App\Models\ProjectMember::create([
                'user_id'      => $user->id,
                'project_id'   => $projectId,
                'project_role' => $request->role === 'INSTRUCTOR' ? 'LEADER' : 'MEMBER',
            ]);
        }
    }

    // ❌ Elimina esta línea: dd($request->all());

    return redirect()->route('users.index')
        ->with('success', 'Usuario ' . $user->first_name . ' actualizado correctamente.');
}

    
    // Delete
    public function destroy($id)
    {
    {
        try {
            $user = User::findOrFail($id);
            
            // Opcional: Verificar que no sea el último administrador
            if ($user->role === 'ADMIN' && User::where('role', 'ADMIN')->count() <= 1) {
                return response()->json([
                    'message' => 'No se puede eliminar el único administrador del sistema'
                ], 400);
            }
            
            // Eliminar relaciones con proyectos (pivot table)
            $user->projects()->detach();
            
            $user->delete();
            
            return response()->json([
                'message' => 'Usuario eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ], 500);
        }
    
    }
}
}

