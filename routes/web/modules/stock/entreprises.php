<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Entreprises Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock entreprise web routes for your application.
|
*/

// Routes Entreprises
Route::get('/entreprises', 'EntrepriseController@index')->name('entreprise.index');
Route::get('/entreprise/create', 'EntrepriseController@create')->name('entreprise.create');
Route::post('/entreprise/store', 'EntrepriseController@store')->name('entreprise.store');
Route::get('/entreprise/edit', 'EntrepriseController@edit')->name('entreprise.edit');
Route::any('/entreprise/update', 'EntrepriseController@update')->name('entreprise.update');
Route::get('/entreprise/destroy/{slug}', 'EntrepriseController@destroy')->name('entreprise.destroy');
