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
    });

    Route::get('/{id}', [BlogController::class, 'show']);

    Route::get('/{id}/edit', function ($id) {
        return view('blogs.edit', ['id' => $id]);
    });
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/{id}', [UserController::class, 'show']);
});

Route::get('score-board', function () {
    return view('score-board');
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
