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
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view('users.index')->with('users', $users);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required', 'lowercase', 'email', 'unique:' . User::class],
            'password'      => ['required', 'confirmed'],
            'role'          => ['required', new Enum(RoleEnum::class)],
            'status'        => ['required', 'boolean'],
            'cohort_id'     => ['required', 'exists:cohorts,id'],
        ]);
        $user = new User();
        $user->first_name = $request       ->first_name;
        $user->last_name  = $request       ->last_name;
        $user->email      = $request       ->email;
        $user->password   = bcrypt($request->password);
        $user->role       = $request       ->role;
        $user->status     = $request       ->boolean('status');
        $user->cohort_id  = $request       ->cohort_id;

        if ($user->save()) {
            return redirect('users')->with('success', 'User ' . $user->first_name . $user->last_name . ' was successfully added.');
        }
    }
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }
    public function update(Request $request, User $user)
    {
        $validation = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'email'      => ['required', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $user->id],
            'role'       => ['required', new Enum(RoleEnum::class)],
            'status'     => ['required', 'boolean'],
            'cohort_id'  => ['required', 'exists:cohorts,id'],
        ]);

        $validation['status'] = $request->boolean('status');

        $user->update($validation);

        return redirect('users')
            ->with('success', 'User ' . $user->first_name . ' ' . $user->last_name . ' was successfully updated.');
    }
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect('users')->with('success', 'User ' . $user->first_name . ' ' . $user->last_name . ' was successfully deleted.');
        }
    }

}
