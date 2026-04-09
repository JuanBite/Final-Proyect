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

    return view('gestion.index', [
        'tab'     => $tab,
        'regions' => Region::orderBy('id')->paginate(55),
        'centers' => Center::with('region')->paginate(55),
        'cohorts'  => Cohort::with('center')->paginate(55),
    ]);
}
}
