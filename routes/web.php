<?php

use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\MovieDetailController;
use App\Http\Controllers\Client\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('/', function () {
//     return view('client.home');
// })->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('policy', [HomeController::class, 'policy'])->name('policy');    //Trang Chính sách

Route::get('movie/{slug}', [MovieDetailController::class, 'show'])->name('movie-detail');

Route::get('choose-seat', function () {
    return view('client.choose-seat');
})->name('choose-seat');

Route::get('login', function () {
    return view('client.login');
})->name('login');

Route::get('register', function () {
    return view('client.register');
})->name('register');

Route::get('my-account', function () {
    return view('client.my-account');
})->name('my-account');

Route::get('checkout', function () {
    return view('client.checkout');
})->name('checkout');


Route::get('forgot-password', function () {
    return view('client.forgot-password');
})->name('forgot-password');

Route::get('showtime', function () {
    return view('client.showtime');
})->name('showtime');

// Contact
Route::get('contact', function () {
    return view('client.contact');
})->name('contact');

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('introduce', function () {
    return view('client.introduce');
})->name('introduce');

Auth::routes(['verify' => true]);
