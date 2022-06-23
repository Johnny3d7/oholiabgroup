<?php

use App\Http\Controllers\Achat\AchatController;
use App\Http\Controllers\Achat\BesoinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Achat Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module achat web routes for your application.
|
*/


Route::prefix('/achats')->name('achats.')->group(function () {
    Route::get('/', [AchatController::class, 'index'])->name('index');

    Route::prefix('besoins')->name('besoins.')->group(function(){
        Route::put('lignes/{ligne}', [BesoinController::class, 'updateLigne'])->name('lignes.update');
    });

    Route::resource('besoins', BesoinController::class);

    Route::get('besoins/{besoin}/validation', [BesoinController::class, 'validation'])->name('besoins.validation');
});
