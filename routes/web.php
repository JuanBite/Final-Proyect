<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/projects', function () {
        return view('projects.index');
    });
    Route::get('/projects/details', function () {
        return view('projects.details');
    });
    Route::get('/stats', function () {
        return view('stats.index');
    });
    Route::get('/users', function () {
        return view('users.index');
    });
    Route::get('/users/detail', function () {
        return view('users.detail');
    });
    Route::get('/regions', function () {
        return view('regions.index');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
