<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMember;
use App\Models\User;
class ProjectMemberController extends Controller
{
    // List
    public function index()
    {
        $users = User::with(['projects', 'projectMembers'])
                 ->orderBy('id', 'desc')
                 ->paginate(20);

                 $proyectMember = ProjectMember::orderBy('id', 'desc');

    return view('users.index')->with('users', $users);
    }
}
