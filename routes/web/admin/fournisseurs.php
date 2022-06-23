<?php

use App\Http\Controllers\Admin\Fournisseur\FournisseurController;
use App\Http\Controllers\Admin\Fournisseur\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/fournisseurs')->name('fournisseurs.')->group(function () {
    // Route::get('/', [FournisseurController::class, 'index'])->name('index');
    // Route::post('create', [FournisseurController::class, 'store'])->name('store');
    Route::resource('types', TypeController::class);
});
Route::resource('fournisseurs', FournisseurController::class);
