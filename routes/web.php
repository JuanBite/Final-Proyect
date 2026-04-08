<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GestionController;



Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/stats', function () {
        return view('stats.index');
    });

    Route::get('/gestion', [GestionController::class, 'index'])->name('gestion');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);

    // Users
    Route::resource('users', UserController::class);
    Route::get('/users/detail/{id}', [UserController::class, 'show'])->name('users.show');

    // REGIONS
    Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
    Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
    Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');

    // CENTERS
    Route::post('/centers', [CenterController::class, 'store'])->name('centers.store');
    Route::put('/centers/{center}', [CenterController::class, 'update'])->name('centers.update');
    Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');

    // COHORTS
    Route::post('/cohorts', [CohortController::class, 'store'])->name('cohorts.store');
    Route::put('/cohorts/{cohort}', [CohortController::class, 'update'])->name('cohorts.update');
    Route::delete('/cohorts/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy');


});


require __DIR__ . '/auth.php';
