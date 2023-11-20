<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\TicketController;

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

Route::get('/', [EventController::class, 'index'])->name('homepage');

Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');

    Route::prefix('/reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
        Route::prefix('/{reservation}/tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketController::class, 'index'])->name('index');
            Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
        });
    });
});

Route::prefix('/events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{event}', [EventController::class, 'show'])->name('show');
    Route::get('/{event}/order', [EventController::class, 'order'])->middleware('auth')->name('order');
    Route::post('/{event}/reserve', [EventController::class, 'reserve'])->middleware('auth')->name('reserve');
});

Route::prefix('/admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('/reservations')->name('reservations.')->group(function() {
        Route::get('/', [AdminReservationController::class, 'index'])->name('index');
        Route::get('/{reservation}', [AdminReservationController::class, 'show'])->name('show');
        Route::get('/{reservation}/edit', [AdminReservationController::class, 'edit'])->name('edit');
        Route::get('/{reservation}/tickets', [AdminReservationController::class, 'tickets'])->name('tickets');
        Route::patch('/{reservation}', [AdminReservationController::class, 'update'])->name('update');
        Route::patch('/{reservation}/reset', [AdminReservationController::class, 'reset'])->name('reset');
    });

    Route::prefix('/events')->name('events.')->group(function () {
        Route::get('/', [AdminEventController::class, 'index'])->name('index');
        Route::get('/create', [AdminEventController::class, 'create'])->name('create');
        Route::post('/', [AdminEventController::class, 'store'])->name('store');
        Route::get('/{event}/edit', [AdminEventController::class, 'edit'])->name('edit');
        Route::patch('/{event}', [AdminEventController::class, 'update'])->name('update');
        Route::delete('/{event}', [AdminEventController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->name('profile.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
