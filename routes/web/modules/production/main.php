<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Product Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module product web routes for your application.
|
*/


Route::prefix('/product')->namespace('App\Http\Controllers\Product')->name('product.')->group(function () {
    //
});