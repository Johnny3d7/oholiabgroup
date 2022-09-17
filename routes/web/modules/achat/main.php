<?php

use App\Http\Controllers\Achat\AchatController;
use App\Http\Controllers\Achat\BesoinController;
use App\Http\Controllers\Achat\FactureController;
use App\Http\Controllers\Achat\LigneController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Fournisseur\FournisseurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Achat Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module achat web routes for your application.
|
*/


Route::prefix('/achats')->name('achats.')->middleware(['role_or_permission:'.config('constants.roles.chgachat').'|'.config('constants.roles.dg')])->group(function () {
    Route::get('/', [AchatController::class, 'index'])->name('index');

    Route::prefix('besoins')->name('besoins.')->group(function(){
        Route::put('lignes/{ligne}', [BesoinController::class, 'updateLigne'])->name('lignes.update');
        Route::post('lignes/validation', [BesoinController::class, 'validationLigne'])->name('lignes.validation');
    });
    Route::resource('besoins', BesoinController::class);
    Route::post('besoins/{besoin}/validation', [BesoinController::class, 'validation'])->name('besoins.validation');

    Route::prefix('factures')->name('factures.')->group(function(){
        Route::put('lignes/{ligne}', [FactureController::class, 'updateLigne'])->name('lignes.update');
    });
    Route::resource('factures', FactureController::class);
    Route::resource('ligne_factures', LigneController::class);

    Route::get('/founisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');

});
