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
});

Route::get('movie-detail', function () {
    return view('client.movie-detail');
});

Route::get('choose-seat', function () {
    return view('client.choose-seat');
});

Route::get('login', function () {
    return view('client.login');
});
Route::get('register', function () {
    return view('client.register');
});
Route::get('forgot', function () {
    return view('client.forgot-password');
});
