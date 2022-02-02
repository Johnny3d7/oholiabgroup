<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Commande fournisseur Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register commande fournisseur web routes for your application.
|
*/


Route::get('/commandes-fournisseur', 'App\Http\Controllers\Stock\CommandeFournisseurController@index')->name('commande_fournisseur.index');
Route::get('/commandes-fournisseur-recu', 'App\Http\Controllers\Stock\CommandeFournisseurController@commandeRecu')->name('commande_fournisseur.recu');
Route::get('/commandes-fournisseur/show/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@show')->name('commande_fournisseur.show');
Route::get('/commandes-fournisseur/create', 'App\Http\Controllers\Stock\CommandeFournisseurController@create')->name('commande_fournisseur.create');
Route::post('/commandes-fournisseur/store', 'App\Http\Controllers\Stock\CommandeFournisseurController@store')->name('commande_fournisseur.store');
Route::get('/commandes-fournisseur/edit/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@edit')->name('commande_fournisseur.edit');
Route::any('/commandes-fournisseur/update/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@update')->name('commande_fournisseur.update');
Route::get('/commandes-fournisseur/destroy/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@destroy')->name('commande_fournisseur.destroy');

Route::get('/commandes-fournisseur/view/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@view')->name('commande_fournisseur.view');
Route::get('/commandes-fournisseur/viewlivraison/{id}', 'App\Http\Controllers\Stock\CommandeFournisseurController@viewlivraison')->name('commande_fournisseur.viewlivraison');

//Produits d'une commande fournisseur
Route::post('/commande-fournisseur/add-product', 'App\Http\Controllers\Stock\CommandeFournisseurController@addProduct')->name('commande_fournisseur.add_Product');
Route::get('/commandes-fournisseur/update-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeFournisseurController@updateProduct')->name('commande_fournisseur.update_Product');
Route::get('/commandes-fournisseur/delete-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeFournisseurController@deleteProduct')->name('commande_fournisseur.delete_Product');

//Action commande fournisseur

//Restauration de la commande
Route::get('/commande-fournisseur/restaurer/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@restaurer')->name('commande_fournisseur.restaurer');
// Quand stock disponible
Route::get('/commande-fournisseur/valider/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@valider')->name('commande_fournisseur.valider');
//En cas de défaut du stock
Route::get('/commande-fournisseur/rejeter/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@rejeter')->name('commande_fournisseur.rejeter');
//En cas d'annulation du client
Route::get('/commande-fournisseur/annuler/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@annuler')->name('commande_fournisseur.annuler');
//Classer comme livré
Route::get('/commande-fournisseur/livrer/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@livrer')->name('commande_fournisseur.livrer');

//Validation au niveau du fournisseur
Route::get('/commandes-fournisseur/accept/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@accept')->name('commande_fournisseur.accept');
//REfuser par le fournisseur
Route::get('/commandes-fournisseur/refuse/{slug}', 'App\Http\Controllers\Stock\CommandeFournisseurController@refuse')->name('commande_fournisseur.refuse');
//Créer un bon de livraison
Route::post('/commande-fournisseur/create-bon-livraison', 'App\Http\Controllers\Stock\CommandeFournisseurController@create_bon_livraison')->name('commande_fournisseur.create_bon_livraison');
