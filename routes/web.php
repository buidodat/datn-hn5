<?php

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



Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('movie-detail', function () {
    return view('client.movie-detail');
})->name('movie-detail');

Route::get('choose-seat', function () {
    return view('client.choose-seat');
})->name('choose-seat');

Route::get('login', function () {
    return view('client.login');
})->name('login');

Route::get('register', function () {
    return view('client.register');
})->name('register');


Route::get('checkout', function () {
    return view('client.checkout');
})->name('checkout');


Route::get('forgot-password', function () {
    return view('client.forgot-password');
})->name('forgot-password');

Route::get('showtime', function () {
    return view('client.showtime');
})->name('showtime');
