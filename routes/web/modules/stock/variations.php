<?php

use App\Http\Controllers\Stock\ProductController;
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
Route::get('/etat-du-stock/{slug}', [ProductController::class, 'etatstock'])->name('etat_stock.index');

//Historique stock d'un produit
Route::get('/historique-des-mouvements/comp/{entreprise}/{slug}', [ProductController::class, 'stockStoryComp'])->name('stock_story.index');
Route::get('/historique-des-mouvements/entp/{entrepot}/{slug}', [ProductController::class, 'stockStoryEntp'])->name('stock_story_entrepot.index');

// Routes Variations
Route::get('/variations', 'VariationController@index')->name('variation.index');
Route::get('/variation/create', 'VariationController@create')->name('variation.create');
Route::post('/variations/store', 'VariationController@store')->name('variation.store');
Route::get('/variations/edit/{id}', 'VariationController@edit')->name('variation.edit');
Route::get('/variations/update/{id}', 'VariationController@update')->name('variation.update');
Route::get('/variations/destroy/{id}', 'VariationController@destroy')->name('variation.destroy');
