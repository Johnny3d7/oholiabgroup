<?php

use App\Http\Controllers\ParcInfo\DeviceController;
use App\Http\Controllers\ParcInfo\ParcInfoController;
use App\Http\Controllers\ParcInfo\TypeDeviceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('parc-info')->name('parcinfo.')->group(function () {
    Route::get('/', [ParcInfoController::class, 'index'])->name('index');

    Route::prefix('appareils')->name('devices.')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('create', [DeviceController::class, 'create'])->name('create');
        Route::post('store', [DeviceController::class, 'store'])->name('store');
        Route::get('show/{id}', [DeviceController::class, 'show'])->name('show');
        Route::get('edit/{id}', [DeviceController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [DeviceController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [DeviceController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->name('types.')->group(function () {
        Route::get('/', [TypeDeviceController::class, 'index'])->name('index');
        Route::get('create', [TypeDeviceController::class, 'create'])->name('create');
        Route::post('store', [TypeDeviceController::class, 'store'])->name('store');
        Route::get('show/{id}', [TypeDeviceController::class, 'show'])->name('show');
        Route::get('edit/{id}', [TypeDeviceController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [TypeDeviceController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TypeDeviceController::class, 'destroy'])->name('destroy');
    });
});