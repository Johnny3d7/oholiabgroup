<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Achat Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module achat web routes for your application.
|
*/


Route::prefix('/achat')->namespace('App\Http\Controllers\Achat')->name('achats.')->group(function () {
    Route::view('/', 'main.achats.index')->name('index');
});