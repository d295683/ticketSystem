<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiAuthController;

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
Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('logout', [ApiAuthController::class, 'logout']);
    Route::get('refresh', [ApiAuthController::class, 'refresh']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->get('/user', function (Request $request) {
    return $request->user();
});
