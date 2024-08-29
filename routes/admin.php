<?php

use App\Http\Controllers\Admin\FoodController;
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
                })->name('list');

                Route::get('create', function () {
                    return view('admin.posts.create');
                })->name('create');
            });





        //--Start Route Giới thiệu---

        Route::get('introduces', function() {
            return view('admin.posts.index');
        });
        Route::get('introduces/create', function() {
            return view('admin.posts.create');
        });
        Route::get('cities', function() {
            return view('admin.cities.index');
        });
        Route::get('cities/create', function() {
            return view('admin.cities.create');
        });
        

        // Route::get('posts/edit', function() {
        //     return view('admin.posts.edit');
        // });

        //--End Route Giới thiệu---

    });
