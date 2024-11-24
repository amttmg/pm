<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('projects', 'projects')
    ->middleware(['auth', 'verified'])
    ->name('projects');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('projects', 'projects')
    ->middleware(['auth'])
    ->name('projects');
Route::view('projects/{id}', 'projects-details')
    ->middleware(['auth'])
    ->name('projects.details');

require __DIR__ . '/auth.php';
