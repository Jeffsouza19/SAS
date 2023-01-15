<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/ping', function () {
    return 'pong';
});


Route::any('/unauthenticated', function () {
    return ['error' => 'Usuario nao autentificado'];
})->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/register', 'store')->name('auth.store');
    Route::post('/logout', 'logout')->name('auth.logout');
});

Route::controller(BookController::class)->prefix('book')->group(function () {
    Route::get('/', 'index')->name('book.index');
    Route::post('/store', 'store')->name('book.store');
    Route::get('/edit', 'edit')->name('book.edit');
    Route::put('/update', 'update')->name('book.update');
    Route::delete('/delete', 'destroy')->name('book.delete');
});

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/edit', 'edit')->name('user.edit');
    Route::post('/store', 'store')->name('user.store');
    Route::put('/update', 'update')->name('user.update');
    Route::delete('/delete', 'destroy')->name('user.delete');
});
