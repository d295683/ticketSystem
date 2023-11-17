<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\UserController;

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

/**
 * Auth routes
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
});

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user()->load('roles', 'reservations', 'reservations.tickets');
// });

Route::prefix('/events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{event}', [EventController::class, 'show'])->name('show');
});

Route::prefix('/me')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/roles', [UserController::class, 'roles']);
    Route::get('/reservations', [UserController::class, 'reservations']);
    Route::get('/reservations/{reservation}', [UserController::class, 'reservation']);
});
