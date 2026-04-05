<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\projectHistoryController;
use App\Http\Controllers\projectMemberController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GestionController;



Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/projects', function () {
        $projects = App\Models\Project::with('users')->get();
        return view('projects.index', compact('projects'));
    });
    Route::get('/stats', function () {
        return view('stats.index');
    });
    Route::get('/users', function () {
        $users = App\Models\User::all();
        $projectMembers = App\Models\ProjectMember::all();
        return view('users.index', compact('users', 'projectMembers'));
    });
    Route::get('/users/detail', function () {
        $users = App\Models\User::all();
        return view('users.detail', compact('users'));
    });
    Route::get('/gestion', [GestionController::class, 'index'])->name('gestion');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::resource('centers', CenterController::class);
    Route::resource('cohorts', CohortController::class);
    Route::resource('users', UserController::class);
    // REGIONS
    Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
    Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
    Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');

    // CENTERS
    Route::post('/centers', [CenterController::class, 'store'])->name('centers.store');
    Route::put('/centers/{id}', [CenterController::class, 'update'])->name('centers.update');
    Route::delete('/centers/{id}', [CenterController::class, 'destroy'])->name('centers.destroy');

    // COHORTS
    Route::post('/cohorts', [CohortController::class, 'store'])->name('cohorts.store');
    Route::put('/cohorts/{id}', [CohortController::class, 'update'])->name('cohorts.update');
    Route::delete('/cohorts/{id}', [CohortController::class, 'destroy'])->name('cohorts.destroy');


});





require __DIR__ . '/auth.php';
