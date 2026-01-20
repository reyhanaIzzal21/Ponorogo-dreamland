<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.pages.dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
