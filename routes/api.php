<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Url\UrlController;

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

Route::group([
    'prefix' => 'auth',
    'as'     => 'auth.'
],
    function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});

Route::group([
    'prefix'     => 'url',
    'as'         => 'url.',
    'middleware' => ['auth:sanctum']
],
    function () {
        Route::get('list', [UrlController::class, 'list'])->name('list');
        Route::post('store', [UrlController::class, 'store'])->name('store');
        Route::put('update', [UrlController::class, 'update'])->name('update');
        Route::delete('delete', [UrlController::class, 'delete'])->name('delete');
});


