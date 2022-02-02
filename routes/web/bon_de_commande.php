<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bon de Commande Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register bon de commande web routes for your application.
|
*/


//Les routes des bons de commande et de livraison
Route::get('/bon-de-commandes', 'App\Http\Controllers\Stock\BonCommandeController@index')->name('boncommande.index');
Route::get('/bon-de-commandes/show/{id}', 'App\Http\Controllers\Stock\BonCommandeController@show')->name('boncommande.show');
Route::get('/bon-de-commandes/create', 'App\Http\Controllers\Stock\BonCommandeController@create')->name('boncommande.create');
Route::post('/bon-de-commandes/store', 'App\Http\Controllers\Stock\BonCommandeController@store')->name('boncommande.store');
Route::get('/bon-de-commandes/edit/{id}', 'App\Http\Controllers\Stock\BonCommandeController@edit')->name('boncommande.edit');
Route::any('/bon-de-commandes/update/{id}', 'App\Http\Controllers\Stock\BonCommandeController@update')->name('boncommande.update');
Route::get('/bon-de-commandes/destroy/{id}', 'App\Http\Controllers\Stock\BonCommandeController@create')->name('boncommande.destroy');

//Importer la proforma d'un bon de commande
Route::any('/bon-de-commandes/add_proforma/{id}', 'App\Http\Controllers\Stock\BonCommandeController@addProforma')->name('boncommande.add_proforma');

//Produit d'un bon de commande
Route::post('/bon-commande-fournisseur/add-product', 'App\Http\Controllers\Stock\BonCommandeController@addProduct')->name('bon_commande_fournisseur.add_Product');
Route::get('/bon-commande-fournisseur/update-product/{bonCommande}/{product}', 'App\Http\Controllers\Stock\BonCommandeController@updateProduct')->name('bon_commande_fournisseur.update_Product');
Route::get('/bon-commande-fournisseur/delete-product/{bonCommande}/{product}', 'App\Http\Controllers\Stock\BonCommandeController@deleteProduct')->name('bon_commande_fournisseur.delete_Product');

//(Ajax) bon de commande get product form fournisseur
Route::get('bon-commande-products-fournisseur/{id}', 'App\Http\Controllers\Stock\AjaxController@getBonCommandeProduct')->name('bon-commande-products-fournisseur.search');
