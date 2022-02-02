<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Modules Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register modules web routes for your application.
| Only shared routes are registered here, specific ones are inside dir.
|
*/


//Liste des modules
Route::middleware('auth')->group(function(){
    Route::get('/modules', 'App\Http\Controllers\ModuleController@index')->name('module.index');
});