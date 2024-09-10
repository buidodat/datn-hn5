<?php

use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TypeRoomController;

use App\Http\Controllers\Admin\TypeSeatController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

// Route::prefix('posts')
//     ->as('posts.')
//     ->group(function () {
//         Route::get('/', function () {
//             return view('admin.posts.index');
//         })->name('index');

//         Route::get('create', function () {
//             return view('admin.posts.create');
//         })->name('create');
//     });

// City
Route::resource('branches', BranchController::class);
// Cinema
Route::resource('cinemas', CinemaController::class);
// Payment
Route::resource('payments', PaymentController::class);
// Payment
Route::resource('payments', PaymentController::class);

Route::resource('slideshows', \App\Http\Controllers\Admin\SlideShowController::class);
Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class);




Route::resource('contacts', ContactController::class);
Route::resource('movies', MovieController::class);

Route::resource('type-rooms', TypeRoomController::class); 
Route::resource('rooms', RoomController::class);
Route::resource('posts', PostController::class);

Route::get('price-ticket',function(){
    return view('admin.price-ticket');
});

// food
Route::resource('food', FoodController::class);
// Combo
Route::resource('combos', ComboController::class);
// TypeSeat
Route::resource('type_seats', TypeSeatController::class);
Route::resource('rooms', RoomController::class);

