<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Center;
use App\Models\Cohort;

class GestionController extends Controller
{
    public function index(Request $request)
{
    $tab = $request->input('tab', 'regions');

    return view('regions.index', [
        'tab'     => $tab,
        'regions' => Region::orderBy('id')->paginate(20),
        'centers' => Center::with('region')->paginate(20),
        'cohorts'  => Cohort::with('center')->paginate(20),
    ]);
}
}
