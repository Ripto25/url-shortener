<?php

use Illuminate\Support\Facades\Route;
use App\Models\Url;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{url}', function ($url) {
    $data = Url::where('short_url', $url)->first();
    return Redirect::to($data->original_url);
});

