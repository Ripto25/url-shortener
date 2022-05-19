<?php
use App\Http\Controllers\Auth\AuthController;

Route::group([
    'prefix' => 'auth',
    'as'     => 'auth.'
],
    function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});
