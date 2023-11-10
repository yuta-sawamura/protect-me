<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;

// use App\Http\Controllers\ScoreController;

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

Route::get('/', [BlogController::class, 'index'])->name('home');

Route::group(['prefix' => 'blogs'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/{id}', [BlogController::class, 'show'])->name('blogs.show');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
        Route::put('/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });
});

Route::group(['prefix' => 'users'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__ . '/auth.php';
