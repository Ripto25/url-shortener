<?php

use App\Http\Controllers\Url\UrlController;

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


