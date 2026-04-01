<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectHistory;

class ProjectHistoryController extends Controller
{
    // List
    public function index()
    {
        $proyectHistory = ProjectHistory::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.index', compact('proyectHistory'));
    }

    // Create
    public function create()
    {
        return view('projects.create');
    }

    // Store
    public function store(Request $request)
    {
        $validation = $request->validate([
            'project_id'   => ['required', 'exists:projects,id'],
            'action'       => ['required', 'string', 'max:255'],
            'performed_by' => ['required', 'exists:users,id'],
        ]);

        $proyectHistory = new ProjectHistory();

        $proyectHistory->project_id   = $request->project_id;
        $proyectHistory->action       = $request->action;
        $proyectHistory->performed_by = $request->performed_by;

        $proyectHistory->save();
    }
}