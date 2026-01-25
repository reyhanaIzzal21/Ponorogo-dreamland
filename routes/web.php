<?php

use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MenuPriceGroupController;
use App\Http\Controllers\MenuController;
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

// User Menu Routes
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/category/{categoryId}/items', [MenuController::class, 'getCategoryItems'])->name('menu.items');

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

    // Menu Management Routes
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [MenuCategoryController::class, 'index'])->name('index');

        // Category Routes
        Route::post('categories', [MenuCategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{id}', [MenuCategoryController::class, 'show'])->name('categories.show');
        Route::put('categories/{id}', [MenuCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}', [MenuCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('categories/reorder', [MenuCategoryController::class, 'reorder'])->name('categories.reorder');

        // Item Routes
        Route::get('items', [MenuItemController::class, 'index'])->name('items.index');
        Route::post('items', [MenuItemController::class, 'store'])->name('items.store');
        Route::get('items/{id}', [MenuItemController::class, 'show'])->name('items.show');
        Route::post('items/{id}', [MenuItemController::class, 'update'])->name('items.update'); // POST for file upload
        Route::delete('items/{id}', [MenuItemController::class, 'destroy'])->name('items.destroy');
        Route::post('items/reorder', [MenuItemController::class, 'reorder'])->name('items.reorder');

        // Price Group Routes
        Route::get('price-groups', [MenuPriceGroupController::class, 'index'])->name('price-groups.index');
        Route::post('price-groups', [MenuPriceGroupController::class, 'store'])->name('price-groups.store');
        Route::get('price-groups/{id}', [MenuPriceGroupController::class, 'show'])->name('price-groups.show');
        Route::put('price-groups/{id}', [MenuPriceGroupController::class, 'update'])->name('price-groups.update');
        Route::delete('price-groups/{id}', [MenuPriceGroupController::class, 'destroy'])->name('price-groups.destroy');
        Route::post('price-groups/{groupId}/items', [MenuPriceGroupController::class, 'addItem'])->name('price-groups.items.add');
        Route::delete('price-groups/items/{itemId}', [MenuPriceGroupController::class, 'removeItem'])->name('price-groups.items.remove');
        Route::post('price-groups/reorder', [MenuPriceGroupController::class, 'reorder'])->name('price-groups.reorder');
    });

    Route::view('landing-page', 'admin.pages.landing-page.index')->name('landing-page');
    Route::view('restaurant', 'admin.pages.restaurant.index')->name('restaurant');
    Route::view('pavilion', 'admin.pages.pavilion.index')->name('pavilion');
    Route::view('pool', 'admin.pages.pool.index')->name('pool');
    Route::view('about', 'admin.pages.about.index')->name('about');
});

require __DIR__ . '/settings.php';
