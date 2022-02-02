<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/parc-info')->namespace('App\Http\Controllers\ParcAuto')->name('parcinfo.')->group(function () {
    Route::view('/', 'main.parcinfo.index')->name('index');
});