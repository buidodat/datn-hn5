<?php

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

        //--End Route Giới thiệu---

    });
