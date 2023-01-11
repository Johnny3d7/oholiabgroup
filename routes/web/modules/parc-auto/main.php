<?php

use App\Http\Controllers\ParcAuto\VehicleController;
use App\Http\Controllers\ParcAuto\ParcAutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcauto web routes for your application.
|
*/


Route::prefix('parc-auto')->name('parcauto.')->group(function () {
    Route::get('/', [ParcAutoController::class, 'index'])->name('index');

    Route::prefix('vehicules')->name('vehicles.')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('index');
        Route::get('create', [VehicleController::class, 'create'])->name('create');
        Route::post('store', [VehicleController::class, 'store'])->name('store');
        Route::get('show/{id}', [VehicleController::class, 'show'])->name('show');
        Route::get('edit/{id}', [VehicleController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [VehicleController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [VehicleController::class, 'destroy'])->name('destroy');
    });

});