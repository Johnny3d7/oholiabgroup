<?php

use App\Http\Controllers\Stock\EntrepotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Entrepot Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock entrepot web routes for your application.
|
*/

//Route Entrepôts
Route::resource('entrepots', EntrepotController::class);
// Route::get('/entrepots', 'EntrepotController@index')->name('entrepots.index');
// Route::get('/entrepot/create', 'EntrepotController@create')->name('entrepot.create');
// Route::get('/entrepot/show/{slug}', 'EntrepotController@show')->name('entrepot.show');
// Route::post('/entrepot/store', 'EntrepotController@store')->name('entrepot.store');
// Route::get('/entrepot/edit/{slug}', 'EntrepotController@edit')->name('entrepot.edit');
// Route::any('/entrepot/update/{slug}', 'EntrepotController@update')->name('entrepot.update');
// Route::get('/entrepot/destroy/{slug}', 'EntrepotController@destroy')->name('entrepot.destroy');