<?php

use App\Http\Controllers\Admin\CMSPageController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware'=>['admin']], function() {
        // Admin Dashboard and Settings
        Route::get('dashboard', 'AdminController@dashboard');
        Route::match(['get', 'post'], 'update-password', 'AdminController@updatePassword');
        Route::match(['get', 'post'], 'update-details', 'AdminController@updateDetails');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::get('logout', 'AdminController@logout');

        // CMS Pages Management
        Route::get('cms-pages', 'CMSPageController@index');
        Route::post('update-cms-pages-status', 'CMSPageController@update');
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CMSPageController@edit');
        Route::get('delete-cms-page/{id?}', 'CMSPageController@destroy');

        // Categories Management
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::get('delete-category/{id?}', 'CategoryController@deleteCategory');

        // Motorcycles Management
        Route::get('motorcycles', 'MotorcyclesController@motorcycles');
        Route::post('update-motorcycles-status', 'MotorcyclesController@updateMotorcyclesStatus');
        Route::match(['get', 'post'], 'add-edit-motorcycles/{id?}', 'MotorcyclesController@addEditMotorcycles');
        Route::get('delete-motorcycle/{id?}', 'MotorcyclesController@deleteMotorcycle');

        // Accessories Management
        Route::get('accessories', 'AccessoriesController@accessories');
        Route::post('update-accessories-status', 'AccessoriesController@updateAccessoriesStatus');
        Route::match(['get', 'post'], 'add-edit-accessories/{id?}', 'AccessoriesController@addEditAccessories');
        Route::get('delete-accessories/{id?}', 'AccessoriesController@deleteAccessory');

        // Reservations Management
        Route::get('reservations', [ReservationController::class, 'reservations'])->name('admin.reservations');
        Route::post('reservations', [ReservationController::class, 'reserveMotorcycle'])->name('admin.reserve.motorcycle');

        //Orders Management
        Route::get('orders', [OrderController::class, 'orders'])->name('admin.orders');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Frontend Routes
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/motorcycles', [PageController::class, 'motorcycles'])->name('motorcycles');
Route::get('/motorcycle/{id}', [PageController::class, 'showMotorcycles'])->name('motorcycle.details');

Route::get('/accessories', [PageController::class, 'accessories'])->name('accessories');
Route::post('/cart/{id}', [PageController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::post('/update-cart', [PageController::class, 'updateCart'])->name('updateCart');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Contact Routes
Route::post('/contact.send', [ContactFormController::class, 'send'])->name('contact.send');

require __DIR__.'/auth.php';
