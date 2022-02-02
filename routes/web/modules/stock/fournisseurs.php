<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Fournisseur Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock fournisseur web routes for your application.
|
*/

// Routes Fournisseurs
Route::get('/fournisseurs', 'FournisseurController@index')->name('fournisseur.index');
Route::get('/fournisseur/create', 'FournisseurController@create')->name('fournisseur.create');
Route::post('/fournisseur/store', 'FournisseurController@store')->name('fournisseur.store');
Route::get('/fournisseur/edit/{slug}', 'FournisseurController@edit')->name('fournisseur.edit');
Route::any('/fournisseur/update/{slug}', 'FournisseurController@update')->name('fournisseur.update');
Route::get('/fournisseur/destroy/{slug}', 'FournisseurController@destroy')->name('fournisseur.destroy');
