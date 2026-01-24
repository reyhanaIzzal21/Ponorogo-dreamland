<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.pages.home');
})->name('home');

Route::get('/about', function () {
    return view('user.pages.about');
})->name('about');

Route::get('/dam-cokro-resto', function () {
    return view('user.pages.destinations.restaurant.index');
})->name('dam-cokro-resto');
Route::get('/menu', function () {
    return view('user.pages.destinations.restaurant.menu');
})->name('menu');
Route::get('/pavilion', function () {
    return view('user.pages.destinations.pavilion.index');
})->name('pavilion');
Route::get('/pool', function () {
    return view('user.pages.destinations.pool.index');
})->name('pool');
Route::get('/reservation', function () {
    return view('user.pages.reservations.index');
})->name('reservation');
Route::get('/reservation/form', function () {
    return view('user.pages.reservations.form');
})->name('reservation.form');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.pages.dashboard')->name('dashboard');

    Route::view('landing-page', 'admin.pages.landing-page.index')->name('landing-page');
    Route::view('restaurant', 'admin.pages.restaurant.index')->name('restaurant');
    Route::view('pavilion', 'admin.pages.pavilion.index')->name('pavilion');
    Route::view('pool', 'admin.pages.pool.index')->name('pool');
    Route::view('about', 'admin.pages.about.index')->name('about');
});

require __DIR__ . '/settings.php';
