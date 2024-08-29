<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        });

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


        Route::get('cities', function() {
            return view('admin.cities.index');
        });
        Route::get('cities/create', function() {
            return view('admin.cities.create');
        });

        Route::resource('contacts', ContactController::class);


    });
