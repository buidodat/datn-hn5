<?php

use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Auth\LoginFacebookController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ChooseSeatController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\MovieDetailController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\ShowtimeController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\MoMoPaymentController;
use App\Http\Controllers\Client\MovieController;
use App\Http\Controllers\Client\TicketPriceController;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
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
Route::get('policy', [HomeController::class, 'policy'])->name('policy');


Route::prefix('movies')
    ->as('movies.')
    ->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('index');
        Route::get('{slug}', [MovieDetailController::class, 'show'])->name('movie-detail');
        Route::get('{id}/comments', [MovieDetailController::class, 'getComments'])->name('comments');
        Route::post('{slug}/add-review', [MovieDetailController::class, 'addReview'])->name('addReview');
    });


// lịch chiếu theo rạp
Route::get('showtimes', [ShowtimeController::class, 'show'])->name('showtimes');

Route::get('choose-seat/{id}', [ChooseSeatController::class, 'show'])->name('choose-seat');
Route::post('save-information/{id}', [ChooseSeatController::class, 'saveInformation'])->name('save-information');

// Route giữ ghế cho người dùng
Route::post('/hold-seats', [ChooseSeatController::class, 'holdSeats'])->name('hold-seats');
Route::post('/release-seats', [ChooseSeatController::class, 'releaseSeats'])->name('release-seats');

Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('applyVoucher')->middleware('auth');
route::post('checkout/cancel-voucher', [CheckoutController::class, 'cancelVoucher'])->name('cancelVoucher');

route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

// Cổng thanh toán
//1 VNPAY
Route::get('vnpay-payment', [PaymentController::class, 'vnPayPayment'])->name('vnpay.payment');
//2 MOMO
Route::get('momo-payment', [PaymentController::class, 'moMoPayment'])->name('momo.payment');
Route::get('momo-return', [PaymentController::class, 'returnPayment'])->name('momo.return');
Route::post('momo-notify', [PaymentController::class, 'notifyPayment'])->name('momo.notify');
//3 ZALOPAY
Route::post('zalopay-payment', [PaymentController::class, 'zaloPayPayment']);

// User - Thông tin tài khoản
Route::get('my-account', [UserController::class, 'edit'])->name('my-account.edit');
Route::put('/my-account/update', [UserController::class, 'update'])->name('my-account.update');
Route::put('my-account/changePassword', [UserController::class, 'changePassword'])->name('my-account.changePassword');

// // User - Lịch sử mua hàng
Route::get('ticket-detail/{id}', [UserController::class, 'ticketDetail'])->name('ticketDetail');
Route::get('transactionHistory', [UserController::class, 'transactionHistory'])->name('transactionHistory');


Route::get('forgot-password', function () {
    return view('client.forgot-password');
})->name('forgot-password');


// Contact
Route::get('contact', function () {
    return view('client.contact');
})->name('contact');

Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('introduce', function () {
    return view('client.introduce');
})->name('introduce');

Auth::routes(['verify' => true]);
// LOGIN FACEBOOK
Route::controller(LoginFacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});
// LOGIN GOOGLE
Route::controller(\App\Http\Controllers\Auth\GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'callBackGoogle');
});

Route::get('movies2', [HomeController::class, 'loadMoreMovies2']);

Route::get('movies3', [HomeController::class, 'loadMoreMovies3']);
Route::get('movies1', [HomeController::class, 'loadMoreMovies1']);
// Route::get('movie/{id}/showtimes', [HomeController::class, 'getShowtimes']);

Route::post('change-cinema', [CinemaController::class, 'changeCinema'])->name('change-cinema');

//Trang tin tức
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

//Viết tạm route chuyển trang admin checkout ở đây 
Route::get('checkoutAdmin', function () {
    return view('admin.book-tickets.checkout');
})->name('checkoutAdmin');

// Giá vé theo chi nhánh
Route::get('ticket-price', [TicketPriceController::class, 'index'])->name('ticket-price');