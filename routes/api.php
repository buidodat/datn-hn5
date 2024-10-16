<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\SeatTemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\BranchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// // Định nghĩa các route chuẩn cho CRUD của Branch
// Route::apiResource('branches', BranchController::class);
Route::get('cinemas/{branchId}', [APIController::class, 'getCinemas']);
Route::get('rooms/{movieId}', [APIController::class, 'getRooms']);
Route::get('movieVersions/{movieId}', [APIController::class, 'getMovieVersion']);
Route::get('getMovieDuration/{movieId}', [APIController::class, 'getMovieDuration']);
Route::get('typeRooms/{typeRoomId}', [APIController::class, 'getTypeRooms']);
Route::middleware('web')->get('movie/{movie}/showtimes', [MovieController::class, 'getShowtimes']);

Route::resource('rooms', RoomController::class);

Route::post('rooms/update-active', [RoomController::class, 'updateActive'])->name('rooms.update-active');

Route::prefix('seat-templates')
    ->as('seat-templates.')
    ->group(function () {
        Route::post('store',    [SeatTemplateController::class, 'store']);
        Route::put('{seatTemplate}',    [SeatTemplateController::class, 'update']);
        Route::post('update-active/{seatTemplate}',    [SeatTemplateController::class, 'updateActive']);
    });

Route::post('seats/soft-delete', [SeatController::class, 'softDelete'])->name('seats.soft-delete');
Route::post('seats/restore', [SeatController::class, 'restore'])->name('seats.restore');
Route::post('seats/soft-delete-row', [SeatController::class, 'softDeleteRow'])->name('seats.soft-delete-row');
Route::post('seats/restore-row', [SeatController::class, 'restoreRow'])->name('seats.restore-row');
Route::post('seats/update-type', [SeatController::class, 'updateSeatType'])->name('seats.update-type');

Route::post('movies/update-active', [MovieController::class, 'updateActive'])->name('movies.update-active');
Route::post('movies/update-hot', [MovieController::class, 'updateHot'])->name('movies.update-hot');



Route::get('getShowtimesByRoom', [APIController::class, 'getShowtimesByRoom']);

Route::post('vouchers',[\App\Http\Controllers\Admin\VoucherController::class, 'store'])->name('vouchers.store');
