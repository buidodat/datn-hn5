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
    return view('welcome');
});

Route::get('home', function () {
    return view('client.home');
});


// <!DOCTYPE html>

// <head>
//     <meta charset="utf-8" />
    
//     <title>
//         @yield('title')
//     </title>

//     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
//     <meta name="description" content="Movie Pro" />
//     <meta name="keywords" content="Movie Pro" />
//     <meta name="author" content="" />
//     <meta name="MobileOptimized" content="320" />
//     <!--Template style -->
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/animate.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/bootstrap.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/font-awesome.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/fonts.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/flaticon.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/owl.carousel.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/owl.theme.default.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/dl-menu.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/nice-select.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/magnific-popup.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/venobox.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/slick.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/style3.css') }}" />
//     <link rel="stylesheet" type="text/css" href="{{ asset('theme/client/css/responsive3.css') }}" />
//     <!-- favicon links -->
//     <link rel="shortcut icon" type="image/png" href="{{ asset('theme/client/images/header/favicon.ico') }}" />
// </head>

