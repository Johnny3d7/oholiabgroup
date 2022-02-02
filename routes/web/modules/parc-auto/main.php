<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcauto web routes for your application.
|
*/


Route::prefix('/parc-auto')->namespace('App\Http\Controllers\ParcAuto')->name('parcauto.')->group(function () {
    Route::view('/', 'main.parcauto.index')->name('index');
});