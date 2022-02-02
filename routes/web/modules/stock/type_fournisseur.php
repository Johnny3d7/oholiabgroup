<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Type Fournisseur Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock type fournisseur web routes for your application.
|
*/

// Routes Type fournisseurs
Route::get('/type_fournisseurs', 'TypeFournisseurController@index')->name('type_fournisseur.index');
Route::get('/type_fournisseur/create', 'TypeFournisseurController@create')->name('type_fournisseur.create');
Route::post('/type_fournisseur/store', 'TypeFournisseurController@store')->name('type_fournisseur.store');
Route::get('/type_fournisseur/edit/{slug}', 'TypeFournisseurController@indeditex')->name('type_fournisseur.edit');
Route::any('/type_fournisseur/update/{slug}', 'TypeFournisseurController@update')->name('type_fournisseur.update');
Route::get('/type_fournisseur/destroy/{slug}', 'TypeFournisseurController@destroy')->name('type_fournisseur.destroy');
