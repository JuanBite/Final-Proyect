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
        return view('regions.index')->with('centers', $centers);
    }

    // Create
    public function create()
    {
        return view('regions.index');
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
            return redirect('centers')->with('success', 'Center ' . $centers->name .  ' was successfully added.');
        }
    }

    // Show
    public function show(Center $centers)
    {
        return view('regions.index')->with('center', $centers);
    }
    // Edit
    public function edit(Center $centers)
    {
        return view('regions.index')->with('center', $centers);
    }
    // Update
    public function update(Request $request, Center $centers)
    {
        $validation = $request->validate([
            'name'          => ['required', 'string'],
            'code'          => ['required', 'string'],
            'region_id'     => ['required', 'string'],
           
        ]);


        $centers->update($validation);

        return redirect('centers')
            ->with('success', 'Center ' . $centers->name . ' was successfully updated.');
    }
    // Delete
    public function destroy(Center $centers)
    {
        if ($centers->delete()) {
            return redirect('centers')->with('success', 'Centers ' . $centers->name . ' was successfully deleted.');
        }
    }
}
