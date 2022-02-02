<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module ressourceh web routes for your application.
|
*/


Route::prefix('/ressourceh')->namespace('App\Http\Controllers\ParcAuto')->name('ressourceh.')->group(function () {
    Route::view('/', 'main.ressourceh.index')->name('index');
});