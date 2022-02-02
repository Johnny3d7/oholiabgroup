<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Obpinc Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register obpinc web routes for your application.
|
*/

Route::get('/obpinc/dashboard', 'App\Http\Controllers\Obpinc\DashboardController@index')->name('index');