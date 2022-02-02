<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Akebie Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register akebie web routes for your application.
|
*/

Route::get('/akebie/dashboard', 'App\Http\Controllers\Akebie\DashboardController@index')->name('index');