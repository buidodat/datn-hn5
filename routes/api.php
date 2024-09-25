<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\MovieController;
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
Route::get('movie/{movie}/showtimes', [MovieController::class, 'getShowtimes']);


