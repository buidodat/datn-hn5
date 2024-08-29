<?php

use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        });

        // Food
        Route::resource('foods', FoodController::class);

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

        Route::prefix('slideshows')
            ->as('slideshows.')
            ->group(function () {

                Route::get('/', function () {
                    return view('admin.slideshows.index');
                })->name('list');

                Route::get('create', function () {
                    return view('admin.slideshows.create');
                })->name('create');

            });


        //--Start Route Giới thiệu---

        Route::get('introduces', function () {
            return view('admin.posts.index');
        });

        Route::get('cities', function () {
            return view('admin.cities.index');
        });
        Route::get('cities/create', function () {
            return view('admin.cities.create');
        });

        Route::resource('contacts', ContactController::class);
    });
