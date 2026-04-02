<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Enums\TaskEnum;
use Illuminate\Validation\Rules\Enum;

class TaskController extends Controller
{
    // Listing
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(20);
        return view('projects.details')->with('tasks', $tasks);
    }

    // Create
    public function create()
    {
        return view('modals.create.project');
    }

    // Store
    public function store(Request $request)
    {
        $validation = $request->validate([
            'project_id'    => ['required', 'string'],
            'title'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'start_date'    => ['required', 'date'],
            'due_date'      => ['required', 'date', 'after_or_equal:start_date'],
            'status'        => ['required', 'boolean'],
            'assigned_to'   => ['required', 'string'],
        ]);
        $tasks = new Task();
        $tasks->project_id       = $request       ->project_id;
        $tasks->title            = $request       ->title;
        $tasks->description      = $request       ->description;
        $tasks->start_date       = $request       ->start_date;
        $tasks->due_date         = $request       ->due_date;
        $tasks->status           = $request       ->bolean('status');
        $tasks->assigned_to      = $request       ->assigned_to;

        if ($tasks->save()) {
            return redirect('task')->with('success', 'Task ' . $tasks->title . ' was successfully added.');
        }
    }

     // Show
    public function show(Task $tasks)
    {
        return view('projects.details')->with('task', $tasks);
    }

    // Edit
    public function edit(Task $tasks)
    {
        return view('modals.edit.project')->with('task', $tasks);
    }

    // Update
    public function update(Request $request, Task $tasks)
    {
        $validation = $request->validate([
            'project_id'    => ['required', 'string'],
            'title'         => ['required', 'string'],
            'description'   => ['required', 'string'],
            'start_date'    => ['required', 'date'],
            'due_date'      => ['required', 'date', 'after_or_equal:start_date'],
            'status'        => ['required', new Enum(TaskEnum::class)],
            'assigned_to'   => ['required', 'string'],
        ]);

        $validation['status'] = $request->boolean('status');

        $tasks->update($validation);

        return redirect('tasks')
            ->with('success', 'Tasks ' . $tasks->title  . ' was successfully updated.');
    }

    // Delete
    public function destroy(Task $tasks)
    {
        if ($tasks->delete()) {
            return redirect('tasks')->with('success', 'task ' . $tasks->title . ' was successfully deleted.');
        }
    }
}
