<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;

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

Route::get('/', [BlogController::class, 'index']);

Route::group(['prefix' => 'blogs'], function () {
    Route::get('/create', function () {
        return view('blogs.create');
    })->name('blogs.create');
    Route::get('/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/{blog}/edit', function ($blog) {
        return view('blogs.edit', ['blog' => $blog]);
    })->name('blogs.edit');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::middleware(['auth'])->group(function () {
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::get('score-board', function () {
    return view('score-board')->name('score-board');
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
