<?php

use App\Http\Controllers\Stock\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock web routes for your application.
|
*/


Route::prefix('/stock')->name('stock.')->group(function () {
    //Tableau de bord
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Routes Catégorie des produits
    require('categorie.php');

    // Routes Produits
    require('produits.php');

    //Route Entrepôts
    require('entrepot.php');

    // Routes Variations
    require('variations.php');

    // Routes Fournisseurs
    require('fournisseurs.php');
    
    // Routes Clients
    require('client.php');
    
    // Routes Entreprises
    require('entreprises.php');

    // Routes Type fournisseurs
    require('type_fournisseur.php');

});