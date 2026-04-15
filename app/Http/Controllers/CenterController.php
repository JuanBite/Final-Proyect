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
        $validation = $request->validate([
            'name'          => ['required', 'string'],
            'code'          => ['required', 'string'],
            'region_id'     => ['required', 'string'],
           
        ]);
        $center = new Center();
        $center->name        = $request       ->name;
        $center->code        = $request       ->code;
        $center->region_id   = $request       ->region_id;
        
       

        if ($center->save()) {
            return redirect()->route('gestion', ['tab' => 'centers'])->with('success', 'Center ' . $center->name . ' was successfully added.');
        }
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
        $validation = $request->validate([
            'name'          => ['required', 'string'],
            'code'          => ['required', 'string'],
            'region_id'     => ['required', 'string'],
           
        ]);


        $center->update($validation);

        return redirect()->route('gestion', ['tab' => 'centers'])
            ->with('success', 'Center ' . $center->name . ' was successfully updated.');
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
