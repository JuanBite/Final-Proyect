<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    // Listing
    public function index()
    {
        $center = Center::orderBy('id', 'desc')->paginate(20);
        return view('gestion.index')->with('centers', $center);
    }

    // Create
    public function create()
    {
        return view('gestion.index');
    }

    // Store
    public function store(Request $request)
{
    $request->validate([
        'name'      => ['required', 'string'],
        'code'      => ['required', 'string', 'unique:centers,code'],
        'region_id' => ['required', 'exists:region,id'],
    ], [
        'code.unique' => 'Ya existe un centro con ese código.',
    ]);

    $center = Center::create([
        'name'      => $request->name,
        'code'      => $request->code,
        'region_id' => $request->region_id,
    ]);

    return redirect()->route('gestion', ['tab' => 'centers'])
        ->with('success', 'Centro ' . $center->name . ' creado exitosamente.');
}

    // Show
    public function show(Center $center)
    {
        return view('gestion.index')->with('center', $center);
    }
    // Edit
    public function edit(Center $center)
    {
        return view('gestion.index')->with('center', $center);
    }
    // Update
    public function update(Request $request, Center $center)
{
    $request->validate([
        'name'      => ['required', 'string'],
        'code'      => ['required', 'string', 'unique:centers,code,' . $center->id],
        'region_id' => ['required', 'exists:regions,id'],
    ], [
        'code.unique' => 'Ya existe un centro con ese código.',
    ]);

    $center->update([
        'name'      => $request->name,
        'code'      => $request->code,
        'region_id' => $request->region_id,
    ]);

    return redirect()->route('gestion', ['tab' => 'centers'])
        ->with('success', 'Centro ' . $center->name . ' actualizado exitosamente.');
}
    // Delete
    public function destroy(Center $center)
    {
        if ($center->cohort()->exists()) {
        return redirect()->route('gestion', ['tab' => 'centers'])->with('error', 'No puedes eliminar un centro con fichas asociados');
    }
        $center->delete();
            return redirect()->route('gestion', ['tab' => 'centers'])->with('success', 'Centers ' . $center->name . ' was successfully deleted.');
        
    } 
}
