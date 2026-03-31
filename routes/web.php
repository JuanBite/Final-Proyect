<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

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



