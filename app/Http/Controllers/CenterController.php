<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    // Listing
    public function index()
    {
        $centers = Center::orderBy('id', 'desc')->paginate(20);
        return view('gestion.index')->with('centers', $centers);
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
        $centers = new Center();
        $centers->name        = $request       ->name;
        $centers->code        = $request       ->code;
        $centers->region_id   = $request       ->region_id;
        
       

        if ($centers->save()) {
            return redirect()->route('gestion', ['tab' => 'centers'])->with('success', 'Center ' . $centers->name . ' was successfully added.');
        }
    }

    // Show
    public function show(Center $centers)
    {
        return view('gestion.index')->with('center', $centers);
    }
    // Edit
    public function edit(Center $centers)
    {
        return view('gestion.index')->with('center', $centers);
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
