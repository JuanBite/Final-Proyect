<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cohort;

class CohortController extends Controller
{
    // List
    public function index()
    {
        $cohorts = Cohort::orderBy('id', 'desc')->paginate(20);
        return view('cohorts.index', compact('cohorts'));
    }

    // Create
    public function create()
    {
        return view('cohorts.create');
    }

    // Store
    public function store(Request $request)
    {
        $validation = $request->validate([
            'cohort_number' => ['required', 'string', 'max:20'],
            'program_name'  => ['nullable', 'string', 'max:150'],
            'center_id'     => ['required', 'exists:centers,id'],
            'start_date'    => ['nullable', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $cohort = new Cohort();

        $cohort->cohort_number = $request->cohort_number;
        $cohort->program_name  = $request->program_name;
        $cohort->center_id     = $request->center_id;
        $cohort->start_date    = $request->start_date;
        $cohort->end_date      = $request->end_date;

        if ($cohort->save()) {
            return redirect('cohorts')
                ->with('success', 'Cohort ' . $cohort->cohort_number . $cohort->program_name . ' was successfully added.');
        }
    }

    // Show
    public function show(Cohort $cohort)
    {
        return view('cohorts.show', compact('cohort'));
    }

    // Edit
    public function edit(Cohort $cohort)
    {
        return view('cohorts.edit', compact('cohort'));
    }

    // Update
    public function update(Request $request, Cohort $cohort)
    {
        $validation = $request->validate([
            'cohort_number' => ['required', 'string', 'max:20'],
            'program_name'  => ['nullable', 'string', 'max:150'],
            'center_id'     => ['required', 'exists:centers,id'],
            'start_date'    => ['nullable', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $cohort->cohort_number = $validation['cohort_number'];
        $cohort->program_name  = $validation['program_name'];
        $cohort->center_id     = $validation['center_id'];
        $cohort->start_date    = $validation['start_date'] ?? null;
        $cohort->end_date      = $validation['end_date'] ?? null;

        if ($cohort->save()) {
            return redirect('cohorts')
                ->with('success', 'Cohort ' . $cohort->cohort_number . $cohort->program_name . ' was successfully updated.');
        }
    }

    // 🔹 ELIMINAR
    public function destroy(Cohort $cohort)
    {
        if ($cohort->delete()) {
            return redirect('cohorts')->with('success', 'Cohort ' . $cohort->cohort_number . $cohort->program_name . ' was successfully deleted.');
        }
    }
}
