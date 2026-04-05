<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    // List
    public function index() {
        $regions = Region::orderBy('id', 'asc')->paginate(20);
        return view('gestion.index', compact('regions'));
    }

    // Create
    public function create() {
        return view('gestion.index', compact('regions'));
    }

    // store
    public function store(Request $request){
    
    $request->validate([
        'name' => ['required','string'],
        'code' => ['nullable','string'],
    ]);

    $region = new Region();

    $region->name = $request->name;
    $region->code = $request->code;

    $region->save();

    return redirect('gestion')
    ->with('success', 'Region ' . $region->name . ' was successfully added.');
}

    // Show
    public function show(Region $region)
    {
        return view('gestion.index', compact('regions'));   
    }

    // Edit
    public function edit(Region $region)
    {
        return view('gestion.index', compact('regions'));
    }

    // Update
    public function update(Request $request, Region $region)
    {
        $validation = $request->validate([
            'name' => ['required','string'],
            'code' => ['required','string'],
        ]);

         $region->update($request->only('name', 'code'));

        return redirect()->route('gestion', ['tab' => 'regions'])
            ->with('success','Regional' .$region->name .  'actualizada correctamente.');
    }

    // Delete
    public function destroy(Region $region)
{
    if ($region->centers()->exists()) {
        return redirect()->route('gestion', ['tab' => 'regions'])->with('error', 'No puedes eliminar una región con centros asociados');
    }

    $region->delete();

    return redirect()
        ->route('gestion', ['tab' => 'regions'])
        ->with('success', 'Regional ' . $region->name . ' fue eliminada correctamente.');
}
}