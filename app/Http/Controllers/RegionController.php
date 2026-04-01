<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    // List
    public function index() {
        $regions = Region::orderBy('id')->paginate(20);
        return view('regions.index', compact('regions'));
    }

    // Create
    public function create() {
        return view('modals.create.region');
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

    return redirect('regions')
    ->with('success', 'Region ' . $region->name . ' was successfully added.');
}

    // Show
    public function show(Region $region)
    {
        return view('regions.details', compact('region'));     
    }

    // Edit
    public function edit(Region $region)
    {
        return view('modals.edit.region', compact('region'));
    }

    // Update
    public function update(Request $request, Region $region)
    {
        $validation = $request->validate([
            'name' => ['required','string'],
            'code' => ['required','string'],
        ]);

        $region->update($validation);

        return redirect('regions')
            ->with('success', 'Regional ' .$region->name . 'actualizada correctamente.');
    }

    // Delete
    public function destroy(Region $region)
    {
    if ($region->delete()) {
            return redirect('regions')->with('success', 'Regional ' . $region->name . ' was successfully deleted.');
        }
    }
}