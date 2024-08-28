<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin')
    ->group(function (){

        Route::get('/', function() {
            return view('admin.dashboard');
        });

    });
