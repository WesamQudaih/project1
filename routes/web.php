<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AgeCheck;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('cms/admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);

//     Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
//     Route::post('forgot-password', [AuthController::class, 'sendResetEmail'])->name('password.email');
});
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::view('/', 'cms.starter');
    // Route::view('/users', 'cms.users.index')->name('users.index');
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route::resource('users', UserController::class);
    // Route::resource('categories', CategoryController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});

// Route::get('news', function () {
//     echo "Show news - Title";
// })->middleware('age');

// Route::get('news', function () {
//     echo "Show news - Title";
// })->middleware('age:15');

// Route::middleware('age')->get('news', function () {
//     echo "Show news - Title";
// });

// Route::get('news', function () {
//     echo "Show news - Title";
// })->middleware(AgeCheck::class);
