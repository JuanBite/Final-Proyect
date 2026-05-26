<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Cohort;
use App\Models\Region;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // ← NUEVO
        $tab = $request->input('tab', 'regions');
        $search = $request->input('search');

        // ← NUEVO: tabs permitidos según rol
        $allowedTabs = match ($user->role) {
            'ADMIN' => ['regions', 'centers', 'cohorts'],
            'REGIONAL_ADMIN' => ['centers', 'cohorts'],
            'COORDINATOR' => ['cohorts'],
            'INSTRUCTOR' => ['cohorts'],
            default => ['cohorts'],
        };

        // ← NUEVO: redirigir al primer tab permitido si el solicitado no está autorizado
        if (! in_array($tab, $allowedTabs)) {
            $tab = $allowedTabs[0];
        }

        // REGIONS — ← NUEVO: REGIONAL_ADMIN ve solo su regional
        $regionsQuery = Region::query();
        if ($user->isRegionalAdmin()) {                              // ← NUEVO
            $regionsQuery->where('id', $user->region_id);           // ← NUEVO
        }                                                            // ← NUEVO
        if ($search && $tab === 'regions') {
            $regionsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // CENTERS — ← NUEVO: filtrado por regional/centro
        $centersQuery = Center::with('region');
        $centersQuery->when(! $user->isAdmin(), fn ($q) =>          // ← NUEVO
            $q->whereIn('id', $user->visibleCenterIds())           // ← NUEVO
        );                                                          // ← NUEVO
        if ($search && $tab === 'centers') {
            $centersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('region', fn ($q2) => $q2->where('name', 'like', "%{$search}%")
                    );
            });
        }

        // COHORTS — ← NUEVO: filtrado por centro visible / ficha del instructor
        $cohortsQuery = Cohort::with('center.region');
        $cohortsQuery
            ->when(! $user->isAdmin(), fn ($q) =>                    // ← NUEVO
                $q->whereIn('center_id', $user->visibleCenterIds()) // ← NUEVO
            )                                                        // ← NUEVO
            ->when($user->isInstructor(), fn ($q) =>                 // ← NUEVO
                $q->whereIn('id', $user->cohorts()->pluck('cohorts.id'))                   // ← NUEVO
            );                                                       // ← NUEVO
        if ($search && $tab === 'cohorts') {
            $cohortsQuery->where(function ($q) use ($search) {
                $q->where('cohort_number', 'like', "%{$search}%")
                    ->orWhere('program_name', 'like', "%{$search}%")
                    ->orWhereHas('center', fn ($q2) => $q2->where('name', 'like', "%{$search}%")
                        ->orWhereHas('region', fn ($q3) => $q3->where('name', 'like', "%{$search}%")
                        )
                    );
            });
        }

        return view('gestion.index', [
    'tab'        => $tab,
    'allowedTabs' => $allowedTabs,
    'regions'    => $regionsQuery->paginate(12)->withQueryString(),
    'centers'    => $centersQuery->paginate(12)->withQueryString(),
    'cohorts'    => $cohortsQuery->paginate(8)->withQueryString(),

    // ← NUEVO: para los selects del modal, sin paginar ni filtrar por search
    'allRegions' => Region::when($user->isRegionalAdmin(),
                        fn($q) => $q->where('id', $user->region_id)
                    )->orderBy('name')->get(),

    'allCenters' => Center::whereIn('id', $user->visibleCenterIds())
                        ->orderBy('name')->get(),
]);
    }
}
