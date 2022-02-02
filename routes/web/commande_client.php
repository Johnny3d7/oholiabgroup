<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Commande Client Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register commandes client web routes for your application.
|
*/

//Commandes client & actions
Route::get('/commandes', 'App\Http\Controllers\Stock\CommandeController@index')->name('commande.index');
Route::get('/commande-client/show/{slug}', 'App\Http\Controllers\Stock\CommandeController@show')->name('commande_client.show');
Route::get('/commande-client/create', 'App\Http\Controllers\Stock\CommandeController@create')->name('commande_client.create');
Route::post('/commande-client/store', 'App\Http\Controllers\Stock\CommandeController@store')->name('commande_client.store');
Route::get('/commande-client/edit/{slug}', 'App\Http\Controllers\Stock\CommandeController@edit')->name('commande_client.edit');
Route::any('/commande-client/update/{slug}', 'App\Http\Controllers\Stock\CommandeController@update')->name('commande_client.update');
Route::get('/commande-client/destroy/{slug}', 'App\Http\Controllers\Stock\CommandeController@destroy')->name('commande_client.destroy');

//Action commande

//Restauration de la commande
Route::get('/commande-client/restaurer/{slug}', 'App\Http\Controllers\Stock\CommandeController@restaurer')->name('commande_client.restaurer');
// Quand stock disponible
Route::get('/commande-client/valider/{slug}', 'App\Http\Controllers\Stock\CommandeController@valider')->name('commande_client.valider');
//En cas de défaut du stock
Route::get('/commande-client/rejeter/{slug}', 'App\Http\Controllers\Stock\CommandeController@rejeter')->name('commande_client.rejeter');
//En cas d'annulation du client
Route::get('/commande-client/annuler/{slug}', 'App\Http\Controllers\Stock\CommandeController@annuler')->name('commande_client.annuler');
//Classer comme livré
Route::get('/commande-client/livrer/{slug}', 'App\Http\Controllers\Stock\CommandeController@livrer')->name('commande_client.livrer');

//Produit d'une commande client
Route::post('/commande-client/add-product', 'App\Http\Controllers\Stock\CommandeController@addProduct')->name('commande_client.add_Product');
Route::get('/commande-client/update-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeController@updateProduct')->name('commande_client.update_Product');
Route::get('/commande-client/delete-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeController@deleteProduct')->name('commande_client.delete_Product');
