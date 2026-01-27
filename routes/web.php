<?php

use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MenuPriceGroupController;
use App\Http\Controllers\Admin\PavilionPageController;
use App\Http\Controllers\Admin\RestaurantPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PavilionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PoolPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\PoolPageController as AdminPoolPageController;
use App\Http\Controllers\AboutPageController as UserAboutPageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [UserAboutPageController::class, 'index'])->name('about');

Route::get('/dam-cokro-resto', [RestaurantController::class, 'index'])->name('dam-cokro-resto');

// User Menu Routes
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/category/{categoryId}/items', [MenuController::class, 'getCategoryItems'])->name('menu.items');

Route::get('/pavilion', [PavilionController::class, 'index'])->name('pavilion');
Route::get('/pool', [PoolPageController::class, 'index'])->name('pool');
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
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

    // Destination Management Routes
    Route::prefix('destinations')->name('destinations.')->group(function () {
        Route::get('/', [DestinationController::class, 'index'])->name('index');
        Route::post('/', [DestinationController::class, 'store'])->name('store');
        Route::get('/{id}', [DestinationController::class, 'show'])->name('show');
        Route::post('/{id}', [DestinationController::class, 'update'])->name('update');
        Route::delete('/{id}', [DestinationController::class, 'destroy'])->name('destroy');
    });

    // Landing Page Management Routes
    Route::prefix('landing-page')->name('landing-page.')->group(function () {
        Route::get('/', [LandingPageController::class, 'index'])->name('index');
        Route::put('/hero', [LandingPageController::class, 'updateHero'])->name('hero.update');
        Route::put('/about', [LandingPageController::class, 'updateAbout'])->name('about.update');
        Route::put('/why', [LandingPageController::class, 'updateWhy'])->name('why.update');
        Route::put('/moment', [LandingPageController::class, 'updateMoment'])->name('moment.update');
        Route::post('/images', [LandingPageController::class, 'storeImage'])->name('images.store');
        Route::delete('/images/{id}', [LandingPageController::class, 'destroyImage'])->name('images.destroy');
    });

    // Restaurant Page Management Routes
    Route::prefix('restaurant')->name('restaurant.')->group(function () {
        Route::get('/', [RestaurantPageController::class, 'index'])->name('index');
        Route::put('/hero', [RestaurantPageController::class, 'updateHero'])->name('hero.update');
        Route::put('/filosofi', [RestaurantPageController::class, 'updateFilosofi'])->name('filosofi.update');
        Route::put('/best-sellers', [RestaurantPageController::class, 'updateBestSellers'])->name('best-sellers.update');
        Route::post('/gallery', [RestaurantPageController::class, 'storeGalleryImage'])->name('gallery.store');
        Route::delete('/gallery/{id}', [RestaurantPageController::class, 'destroyGalleryImage'])->name('gallery.destroy');
        Route::put('/social-media', [RestaurantPageController::class, 'updateSocialMedia'])->name('social-media.update');
    });

    // Pavilion Page Management Routes
    Route::prefix('pavilion')->name('pavilion.')->group(function () {
        Route::get('/', [PavilionPageController::class, 'index'])->name('index');
        Route::post('/hero', [PavilionPageController::class, 'updateHero'])->name('hero.update');
        Route::put('/specs', [PavilionPageController::class, 'updateSpecs'])->name('specs.update');
        Route::put('/facilities', [PavilionPageController::class, 'updateFacilities'])->name('facilities.update');
        Route::post('/facilities', [PavilionPageController::class, 'storeFacility'])->name('facilities.store');
        Route::post('/facilities/image', [PavilionPageController::class, 'uploadFacilitiesImage'])->name('facilities.image');
        Route::delete('/facilities/{id}', [PavilionPageController::class, 'destroyFacility'])->name('facilities.destroy');
        Route::post('/layouts', [PavilionPageController::class, 'storeLayout'])->name('layouts.store');
        Route::post('/layouts/{id}', [PavilionPageController::class, 'updateLayout'])->name('layouts.update');
        Route::delete('/layouts/{id}', [PavilionPageController::class, 'destroyLayout'])->name('layouts.destroy');
        Route::post('/save-all', [PavilionPageController::class, 'saveAll'])->name('save-all');
    });

    Route::prefix('pool')->name('pool.')->group(function () {
        Route::get('/', [AdminPoolPageController::class, 'index'])->name('index');
        Route::put('/hero', [AdminPoolPageController::class, 'updateHero'])->name('hero.update');
        Route::put('/sneak-peek/{slot}', [AdminPoolPageController::class, 'updateSneakPeek'])->name('sneak-peek.update');
        Route::post('/timeline', [AdminPoolPageController::class, 'storeStage'])->name('timeline.store');
        Route::put('/timeline/{id}', [AdminPoolPageController::class, 'updateStage'])->name('timeline.update');
        Route::delete('/timeline/{id}', [AdminPoolPageController::class, 'destroyStage'])->name('timeline.destroy');
        Route::post('/timeline/{id}/photos', [AdminPoolPageController::class, 'storeStagePhoto'])->name('timeline.photos.store');
        Route::delete('/timeline/photos/{id}', [AdminPoolPageController::class, 'destroyStagePhoto'])->name('timeline.photos.destroy');
    });
    Route::get('about', [AboutPageController::class, 'index'])->name('about');
    Route::put('about', [AboutPageController::class, 'update'])->name('about.update');
});

require __DIR__ . '/settings.php';
