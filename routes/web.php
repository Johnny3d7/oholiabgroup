<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('main.dashboard.dashboard');
});*/

//connexion
Route::get('/login', 'App\Http\Controllers\Stock\DashboardController@loguser')->name('user.login');

//commande client
Route::get('/commandes', 'App\Http\Controllers\Stock\CommandeController@index')->name('commande.index');
Route::get('/commande-client/show/{slug}', 'App\Http\Controllers\Stock\CommandeController@show')->name('commande_client.show');
Route::get('/commande-client/create', 'App\Http\Controllers\Stock\CommandeController@create')->name('commande_client.create');
Route::post('/commande-client/store', 'App\Http\Controllers\Stock\CommandeController@store')->name('commande_client.store');
Route::get('/commande-client/edit/{slug}', 'App\Http\Controllers\Stock\CommandeController@edit')->name('commande_client.edit');
Route::any('/commande-client/update/{slug}', 'App\Http\Controllers\Stock\CommandeController@update')->name('commande_client.update');
Route::get('/commande-client/destroy/{slug}', 'App\Http\Controllers\Stock\CommandeController@destroy')->name('commande_client.destroy');

//Produit d'une commande
Route::post('/commande-client/add-product', 'App\Http\Controllers\Stock\CommandeController@addProduct')->name('commande_client.add_Product');
Route::get('/commande-client/update-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeController@updateProduct')->name('commande_client.update_Product');
Route::get('/commande-client/delete-product/{commande}/{product}', 'App\Http\Controllers\Stock\CommandeController@deleteProduct')->name('commande_client.delete_Product');


//Bon de commande
Route::get('/bon-de-commandes', 'App\Http\Controllers\Stock\CommandeController@boncommande')->name('boncommande.index');
Route::get('/expression_besoin', 'App\Http\Controllers\Stock\CommandeController@expressionbesoin')->name('expression_besoin.index');


//Facture
Route::get('/factures', 'App\Http\Controllers\Stock\FactureController@index')->name('facture.index');


//Livraison
Route::get('/livraisons', 'App\Http\Controllers\Stock\LivraisonController@index')->name('livraison.index');
Route::get('commande-nature/{id}', 'App\Http\Controllers\Stock\AjaxController@getCommandeNature')->name('commande-nature.search');



//Gestion de stock routes
Route::prefix('/stock')->namespace('App\Http\Controllers\Stock')->name('stock.')->group(function () {

    //Tableau de bord
    Route::get('/dashboard', 'DashboardController@index')->name('index');
    
    // Routes Catégorie des produits
    Route::get('/categories', 'ProductCategoryController@index')->name('categories_prod.index');
    Route::get('/category/create', 'ProductCategoryController@create')->name('category_prod.create');
    Route::post('/category/store', 'ProductCategoryController@store')->name('category_prod.store');
    Route::get('/category/edit/{slug}', 'ProductCategoryController@edit')->name('category_prod.edit');
    Route::any('/category/update/{slug}', 'ProductCategoryController@update')->name('category_prod.update');
    Route::get('/category/destroy/{slug}', 'ProductCategoryController@destroy')->name('category_prod.destroy');

    // Routes Produits
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::get('/product/edit/{slug}', 'ProductController@edit')->name('product.edit');
    Route::any('/product/update/{slug}', 'ProductController@update')->name('product.update');
    Route::get('/product/destroy/{slug}', 'ProductController@destroy')->name('product.destroy');

    //Etat du stock
    Route::get('/etat-du-stock/{slug}', 'ProductController@etatstock')->name('etat_stock.index');

    //Historique stock d'un produit
    Route::get('/historique-des-mouvements/{entreprise}/{slug}', 'ProductController@stockStory')->name('stock_story.index');

    // Routes Variations
    Route::get('/variations', 'VariationController@index')->name('variation.index');
    Route::get('/variation/create', 'VariationController@create')->name('variation.create');
    Route::post('/variations/store', 'VariationController@store')->name('variation.store');
    Route::get('/variations/edit/{id}', 'VariationController@edit')->name('variation.edit');
    Route::put('/variations/update/{id}', 'VariationController@update')->name('variation.update');
    Route::get('/variations/destroy/{id}', 'VariationController@destroy')->name('variation.destroy');

    // Routes Fournisseurs
    Route::get('/fournisseurs', 'FournisseurController@index')->name('fournisseur.index');
    Route::get('/fournisseur/create', 'FournisseurController@create')->name('fournisseur.create');
    Route::post('/fournisseur/store', 'FournisseurController@store')->name('fournisseur.store');
    Route::get('/fournisseur/edit/{slug}', 'FournisseurController@edit')->name('fournisseur.edit');
    Route::any('/fournisseur/update/{slug}', 'FournisseurController@update')->name('fournisseur.update');
    Route::get('/fournisseur/destroy/{slug}', 'FournisseurController@destroy')->name('fournisseur.destroy');

    // Routes Clients
    Route::get('/clients', 'ClientController@index')->name('client.index');
    Route::get('/client/create', 'ClientController@create')->name('client.create');
    Route::post('/client/store', 'ClientController@store')->name('client.store');
    Route::get('/client/edit/{slug}', 'ClientController@edit')->name('client.edit');
    Route::any('/client/update/{slug}', 'ClientController@update')->name('client.update');
    Route::get('/client/destroy/{slug}', 'ClientController@destroy')->name('client.destroy');

    // Routes Entreprises
    Route::get('/entreprises', 'EntrepriseController@index')->name('entreprise.index');
    Route::get('/entreprise/create', 'EntrepriseController@create')->name('entreprise.create');
    Route::post('/entreprise/store', 'EntrepriseController@store')->name('entreprise.store');
    Route::get('/entreprise/edit', 'EntrepriseController@edit')->name('entreprise.edit');
    Route::any('/entreprise/update', 'EntrepriseController@update')->name('entreprise.update');
    Route::get('/entreprise/destroy/{slug}', 'EntrepriseController@destroy')->name('entreprise.destroy');

    // Routes Type fournisseurs
    Route::get('/type_fournisseurs', 'TypeFournisseurController@index')->name('type_fournisseur.index');
    Route::get('/type_fournisseur/create', 'TypeFournisseurController@create')->name('type_fournisseur.create');
    Route::post('/type_fournisseur/store', 'TypeFournisseurController@store')->name('type_fournisseur.store');
    Route::get('/type_fournisseur/edit/{slug}', 'TypeFournisseurController@indeditex')->name('type_fournisseur.edit');
    Route::any('/type_fournisseur/update/{slug}', 'TypeFournisseurController@update')->name('type_fournisseur.update');
    Route::get('/type_fournisseur/destroy/{slug}', 'TypeFournisseurController@destroy')->name('type_fournisseur.destroy');

});
