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

$roles = [
    config('constants.roles.geststock'),
    config('constants.roles.dg'),
    config('constants.roles.comptable'),
    config('constants.roles.chefcomptable'),
];
Route::prefix('/stock')->name('stock.')->middleware(['role_or_permission:'.implode("|", $roles)])->group(function () {

    Route::middleware(['role_or_permission:'.config('constants.roles.geststock')])->group(function () {
        //Tableau de bord
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Routes Produits
        require('produits.php');

        // Routes Catégorie des produits
        require('categorie.php');

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

    // Routes Produits
    require('inventaires.php');

});

