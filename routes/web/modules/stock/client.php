<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Client Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock client web routes for your application.
|
*/

// Routes Clients
Route::get('/clients', 'ClientController@index')->name('client.index');
Route::get('/client/create', 'ClientController@create')->name('client.create');
Route::post('/client/store', 'ClientController@store')->name('client.store');
Route::get('/client/edit/{slug}', 'ClientController@edit')->name('client.edit');
Route::any('/client/update/{slug}', 'ClientController@update')->name('client.update');
Route::get('/client/destroy/{slug}', 'ClientController@destroy')->name('client.destroy');

