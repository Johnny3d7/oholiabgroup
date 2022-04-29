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
    
    Route::resource('besoins', BesoinController::class);
});