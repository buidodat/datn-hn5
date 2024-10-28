<?php

use App\Http\Controllers\Admin\AssignRolesController;
use App\Http\Controllers\Admin\BookTicketController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\MyAccountController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatTemplateController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\TicketPriceController;
use App\Http\Controllers\Admin\TypeRoomController;

use App\Http\Controllers\Admin\TypeSeatController;

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('admin.dashboard');
});

// City
Route::resource('branches', BranchController::class);
// Cinema
Route::resource('cinemas', CinemaController::class);
// Payment
Route::resource('payments', PaymentController::class);

Route::resource('slideshows', \App\Http\Controllers\Admin\SlideShowController::class);
Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class);
Route::resource('tickets', \App\Http\Controllers\Admin\TicketController::class);
route::post('tickets/{ticket}/update-status', [\App\Http\Controllers\Admin\TicketController::class, 'updateStatus'])->name('tickets.updateStatus');

Route::resource('contacts', ContactController::class);

// Route::group(['middleware' => ['auth', 'checkPermission:manage movies']], function () {
Route::resource('movies', MovieController::class);
// });


Route::resource('type-rooms', TypeRoomController::class);

// Quản lý phòng chiếu
Route::prefix('rooms')
    ->as('rooms.')
    ->group(function () {
        Route::get('/',                   [RoomController::class, 'index'])->name('index');
        Route::get('edit/{room}', [RoomController::class, 'edit'])->name('edit');
        Route::put('{room}/update', [RoomController::class, 'update'])->name('update');

        Route::get('{room}',     [RoomController::class, 'show'])->name('show');
        Route::get('{room}/destroy',     [RoomController::class, 'destroy'])->name('destroy');
        Route::get('{room}/destroy',     [RoomController::class, 'destroy'])->name('destroy');
    });

Route::prefix('seat-templates')
    ->as('seat-templates.')
    ->group(function () {
        Route::get('/',                     [SeatTemplateController::class, 'index'])->name('index');
        Route::get('{seatTemplate}/edit',   [SeatTemplateController::class, 'edit'])->name('edit');
        Route::put('{seatTemplate}/seat-structure',   [SeatTemplateController::class, 'updateSeatStructure'])->name('update.seat-structure');
        Route::put('{seatTemplate}/info',   [SeatTemplateController::class, 'update'])->name('updateInfo')->name('update.info');
        Route::get('{seatTemplate}',   [SeatTemplateController::class, 'destroy'])->name('destroy');
    });
// Route::resource('rooms', RoomController::class);

Route::resource('posts', PostController::class);

Route::group(['middleware' => ['auth', 'checkPermission:Quản lý suất chiếu']], function () {
    Route::resource('showtimes', ShowtimeController::class);
});


// Route::group(['middleware' => ['auth', 'checkPermission']], function () {
//     Route::resource('showtimes', ShowtimeController::class);
// });



Route::get('ticket-price', [TicketPriceController::class, 'index'])->name('ticket-price');
Route::post('ticket-update', [TicketPriceController::class, 'update'])->name('ticket-update');

// Route::post('admin/ticket-price/update', [TicketPriceController::class, 'update'])->name('admin.ticket-price.update');


// food
Route::resource('food', FoodController::class);
// Combo
Route::resource('combos', ComboController::class);
// TypeSeat
Route::resource('type_seats', TypeSeatController::class);
//user
Route::group(['middleware' => ['auth', 'checkPermission:Quản lý tài khoản']], function () {
    Route::resource('users', UserController::class);
});
// Route::group(['middleware' => ['auth', 'checkPermission:Quản lý tài khoản']], function () {
   
// });


Route::put('users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('users.password.reset');
//my-account
Route::get('my-account', [MyAccountController::class, 'show'])->name('my-account');
Route::get('my-account/edit', [MyAccountController::class, 'edit'])->name('my-account.edit');
Route::put('my-account/update', [MyAccountController::class, 'update'])->name('my-account.update');
Route::post('my-account/change-password', [MyAccountController::class, 'changePassword'])->name('my-account.change-password');


// Đặt vé
Route::prefix('book-tickets')
    ->as('book-tickets.')
    ->group(function () {
        Route::get('/',                      [BookTicketController::class, 'index'])->name('index');
        Route::get('{showtime}',             [BookTicketController::class, 'show'])->name('show');
        Route::post('{showtime}',            [BookTicketController::class, 'payment'])->name('payment');
        // Route::get('{seatTemplate}/edit',   [SeatTemplateController::class, 'edit'])->name('edit');
        // Route::put('{seatTemplate}/update',   [SeatTemplateController::class, 'update'])->name('update');
    });

// Phân quyền
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('assign-roles', AssignRolesController::class);
// Lưu ý: chưa check middleware hết được