<?php

// use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Stock\InventaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Inventaire Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock produit web routes for your application.
|
*/

// Routes Inventaires
Route::prefix('inventaires')->name('inventaires.')->group(function(){
    Route::get('{inventaire}/procede', [InventaireController::class, 'procede'])->name('procede');
    Route::post('{inventaire}/procede', [InventaireController::class, 'procedePost'])->name('procedePost');
    Route::post('{inventaire}/validation', [InventaireController::class, 'validation'])->name('validation');
});

Route::resource('inventaires', InventaireController::class);
