<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\PaymentController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
});

// Combo
Route::resource('combos', ComboController::class);

Route::prefix('posts')
    ->as('posts.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.posts.index');
        })->name('index');

        Route::get('create', function () {
            return view('admin.posts.create');
        })->name('create');
    });

// City
Route::resource('cities', CityController::class);
// Payment
Route::resource('payments', PaymentController::class);

Route::prefix('slideshows')
    ->as('slideshows.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.slideshows.index');
        })->name('list');

        Route::get('create', function () {
            return view('admin.slideshows.create');
        })->name('create');

        Route::get('edit', function () {
            return view('admin.slideshows.edit');
        })->name('edit');

    });

Route::prefix('vouchers')
    ->as('vouchers.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.vouchers.index');
        })->name('list');

        Route::get('create', function () {
            return view('admin.vouchers.create');
        })->name('create');

        Route::get('edit', function () {
            return view('admin.vouchers.edit');
        })->name('edit');

        Route::get('show', function () {
            return view('admin.vouchers.show');
        })->name('show');

    });


Route::resource('contacts', ContactController::class);
Route::resource('movies', MovieController::class);

