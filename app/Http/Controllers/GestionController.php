<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Center;
use App\Models\Cohort;
use App\Models\User;

class GestionController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'regions');
        $search = $request->input('search');

        // REGIONS
        $regionsQuery = Region::query();
        if ($search && $tab === 'regions') {
            $regionsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // CENTERS
        $centersQuery = Center::with('region');
        if ($search && $tab === 'centers') {
            $centersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('region', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // COHORTS
        $cohortsQuery = Cohort::with('center.region');
        if ($search && $tab === 'cohorts') {
            $cohortsQuery->where(function ($q) use ($search) {
                $q->where('cohort_number', 'like', "%{$search}%")
                    ->orWhere('program_name', 'like', "%{$search}%")
                    ->orWhereHas('center', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhereHas('region', function ($q3) use ($search) {
                                $q3->where('name', 'like', "%{$search}%");
                            });
                    });
            });
        }
        if (auth()->user()->role === 'INSTRUCTOR' && $tab !== 'cohorts') {
            $tab = 'cohorts';
        }

        return view('gestion.index', [
            'tab'     => $tab,
            'regions' => $regionsQuery->paginate(12)->withQueryString(),
            'centers' => $centersQuery->paginate(12)->withQueryString(),
            'cohorts' => $cohortsQuery->paginate(8)->withQueryString(),
        ]);
    }
}
