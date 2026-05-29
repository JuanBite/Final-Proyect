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
        return view('gestion.index', compact('cohorts'));
    }

    // Create
    public function create()
    {
        return view('gestion.create');
    }

    // Store
    public function store(Request $request)
{
    $request->validate([
        'cohort_number' => ['required', 'string', 'max:150', 'unique:cohorts,cohort_number'],
        'program_name'  => ['nullable', 'string', 'max:150'],
        'center_id'     => ['required', 'exists:centers,id'],
        'start_date'    => ['nullable', 'date'],
        'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
    ], [
        'cohort_number.unique' => 'Ya existe una ficha con ese número.',
    ]);

    $cohort = Cohort::create([
        'cohort_number' => $request->cohort_number,
        'program_name'  => $request->program_name,
        'center_id'     => $request->center_id,
        'start_date'    => $request->start_date,
        'end_date'      => $request->end_date,
    ]);

    return redirect()->route('gestion', ['tab' => 'cohorts'])
        ->with('success', 'Ficha ' . $cohort->cohort_number . ' creada exitosamente.');
}

    // Show
    public function show(Cohort $cohort)
    {
        return view('gestion.show', compact('cohort'));
    }

    // Edit
    public function edit(Cohort $cohort)
    {
        return view('gestion.edit', compact('cohort'));
    }

    // Update
    public function update(Request $request, Cohort $cohort)
{
    $request->validate([
        'cohort_number' => ['required', 'string', 'max:150', 'unique:cohorts,cohort_number,' . $cohort->id],
        'program_name'  => ['nullable', 'string', 'max:150'],
        'center_id'     => ['required', 'exists:centers,id'],
        'start_date'    => ['nullable', 'date'],
        'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
    ], [
        'cohort_number.unique' => 'Ya existe una ficha con ese número.',
    ]);

    $cohort->update([
        'cohort_number' => $request->cohort_number,
        'program_name'  => $request->program_name,
        'center_id'     => $request->center_id,
        'start_date'    => $request->start_date,
        'end_date'      => $request->end_date,
    ]);

    return redirect()->route('gestion', ['tab' => 'cohorts'])
        ->with('success', 'Ficha ' . $cohort->cohort_number . ' actualizada exitosamente.');
}

    // 🔹 ELIMINAR
    public function destroy(Cohort $cohort)
    {
        if ($cohort->delete()) {
            return redirect()->route('gestion', ['tab' => 'cohorts'])->with('success', 'Cohort ' . $cohort->cohort_number . $cohort->program_name . ' was successfully deleted.');
        }
    }
}
