<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMember;
class ProjectMemberController extends Controller
{
    // List
    public function index()
    {
        $proyectMember = ProjectMember::orderBy('id', 'desc');
    }
}
