<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Private\UserController;
use App\Http\Controllers\Private\LevelController;
use App\Http\Controllers\Private\SchoolYearController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:superadmin|admin']], function () {
        Route::group(['middleware' => ['role:superadmin']], function () {
            Route::resource('levels', LevelController::class)->except('create', 'edit', 'show');
        });
        Route::resource('school-years', SchoolYearController::class)->except('create', 'edit', 'show');
        Route::resource('users', UserController::class)->except('create', 'edit', 'show');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
