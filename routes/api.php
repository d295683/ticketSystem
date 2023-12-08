<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TicketController;

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
Route::name('api.')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::delete('/logout', [AuthController::class, 'logout']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
    });


    Route::prefix('/events')->name('api.events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/{event}', [EventController::class, 'show'])->name('show');
    });

    Route::middleware(['auth:sanctum', 'role:admin'])->post('/tickets/scan', [TicketController::class, 'update']);

    Route::prefix('/me')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/roles', [UserController::class, 'roles']);
        Route::get('/reservations', [UserController::class, 'reservations']);
        Route::get('/reservations/{reservation}', [UserController::class, 'reservation']);
    });
});
