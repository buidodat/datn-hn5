<?php

use App\Http\Controllers\Auth\LoginFacebookController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\MovieDetailController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\UserController;
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
Route::get('movie/{id}/comments', [MovieDetailController::class, 'getComments'])->name('movie.comments');
Route::post('movie/{slug}/add-review', [MovieDetailController::class, 'addReview'])->name('movie.addReview');

Route::get('choose-seat', function () {
    return view('client.choose-seat');
})->name('choose-seat');

Route::get('login', function () {
    return view('client.login');
})->name('login');

Route::get('register', function () {
    return view('client.register');
})->name('register');

Route::get('my-account', [UserController::class, 'edit'])->name('my-account.edit');
Route::put('/my-account/update', [UserController::class,'update'])->name('my-account.update');
Route::put('my-account/changePassword', [UserController::class,'changePassword'])->name('my-account.changePassword');

Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('applyVoucher')->middleware('auth');
route::post('checkout/cancel-voucher', [CheckoutController::class, 'cancelVoucher'])->name('cancelVoucher');



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
// LOGIN FACEBOOK
Route::controller(LoginFacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::get('movies2', [HomeController::class, 'loadMoreMovies2']);

Route::get('movies3', [HomeController::class, 'loadMoreMovies3']);
Route::get('movies1', [HomeController::class, 'loadMoreMovies1']);
