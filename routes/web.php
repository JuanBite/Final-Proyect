<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController, CenterController, CohortController,
    ProjectController, DashboardController, RegionController,
    UserController, GestionController, ProjectTaskController
};
Route::get('/projects/public', [ProjectController::class, 'publicIndex'])->name('projects.universal-search');
Route::get('/', fn() => view('auth.login'));

Route::middleware(['auth', 'active'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil → todos los roles
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Proyectos ─────────────────────────────────────────────────────────────
    // Ver: todos los roles (filtrado por scope + policy)
    Route::get('/projects',          [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Crear/Editar: todos MENOS instructor
    Route::middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR,STUDENT')->group(function () {
        Route::get('/projects/create',           [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects',                 [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit',   [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}',        [ProjectController::class, 'update'])->name('projects.update');
        Route::patch('/projects/{project}',      [ProjectController::class, 'update']);
    });

    // Eliminar: solo ADMIN, REGIONAL_ADMIN, COORDINATOR
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
        ->middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR,STUDENT')
        ->name('projects.destroy');

    // ── Tareas y entregas ─────────────────────────────────────────────────────
    Route::prefix('projects/{project}/tasks')->name('project-tasks.')->group(function () {
        // Tareas: solo COORDINATOR y superiores
        Route::middleware('role:STUDENT')->group(function () {
            Route::post('/',         [ProjectTaskController::class, 'store'])->name('store');
            Route::put('/{task}',    [ProjectTaskController::class, 'update'])->name('update');
            Route::delete('/{task}', [ProjectTaskController::class, 'destroy'])->name('destroy');
        });

        // Entregas: solo aprendices
        Route::middleware('role:STUDENT')->group(function () {
            Route::post('/{task}/submissions',                    [ProjectTaskController::class, 'storeSubmission'])->name('submissions.store');
            Route::delete('/{task}/submissions/{submission}',     [ProjectTaskController::class, 'destroySubmission'])->name('submissions.destroy');
        });

        // Calificar: instructor, coordinador, admin
        Route::post('/{task}/submissions/{submission}/grade',
            [ProjectTaskController::class, 'gradeSubmission'])
            ->middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR,INSTRUCTOR')
            ->name('submissions.grade');
    });

    // ── Usuarios ──────────────────────────────────────────────────────────────
    Route::middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR,INSTRUCTOR')->group(function () {
        Route::get('/users',        [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });

    Route::middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR')->group(function () {
        Route::get('/users/create',      [UserController::class, 'create'])->name('users.create');
        Route::post('/users',            [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}',      [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}',    [UserController::class, 'update']);
        Route::delete('/users/{user}',   [UserController::class, 'destroy'])->name('users.destroy');
    });

    // ── Gestión (Regiones, Centros, Fichas) ───────────────────────────────────
    Route::middleware('role:ADMIN,REGIONAL_ADMIN,COORDINATOR')->group(function () {
        Route::get('/gestion', [GestionController::class, 'index'])->name('gestion');

        Route::middleware('role:ADMIN,REGIONAL_ADMIN')->group(function () {
            Route::post('/centers',          [CenterController::class, 'store'])->name('centers.store');
            Route::put('/centers/{center}',  [CenterController::class, 'update'])->name('centers.update');
            Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');
        });

        Route::post('/cohorts',            [CohortController::class, 'store'])->name('cohorts.store');
        Route::put('/cohorts/{cohort}',    [CohortController::class, 'update'])->name('cohorts.update');
        Route::delete('/cohorts/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy');
    });

    Route::middleware('role:ADMIN')->group(function () {
        Route::post('/regions',           [RegionController::class, 'store'])->name('regions.store');
        Route::put('/regions/{region}',   [RegionController::class, 'update'])->name('regions.update');
        Route::delete('/regions/{region}',[RegionController::class, 'destroy'])->name('regions.destroy');
    });
});

require __DIR__ . '/auth.php';