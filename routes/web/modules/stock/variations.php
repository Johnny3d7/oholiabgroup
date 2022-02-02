<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Produit Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock produit web routes for your application.
|
*/

//Etat du stock
Route::get('/etat-du-stock/{slug}', 'ProductController@etatstock')->name('etat_stock.index');

//Historique stock d'un produit
Route::get('/historique-des-mouvements/{entreprise}/{slug}', 'ProductController@stockStory')->name('stock_story.index');

// Routes Variations
Route::get('/variations', 'VariationController@index')->name('variation.index');
Route::get('/variation/create', 'VariationController@create')->name('variation.create');
Route::post('/variations/store', 'VariationController@store')->name('variation.store');
Route::get('/variations/edit/{id}', 'VariationController@edit')->name('variation.edit');
Route::get('/variations/update/{id}', 'VariationController@update')->name('variation.update');
Route::get('/variations/destroy/{id}', 'VariationController@destroy')->name('variation.destroy');
