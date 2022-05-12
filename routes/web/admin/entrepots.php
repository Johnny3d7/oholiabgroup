<?php

use App\Http\Controllers\Admin\EntrepotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/entrepots')->name('entrepots.')->group(function () {
    Route::get('/', [EntrepotController::class, 'index'])->name('index');
    Route::post('create', [EntrepotController::class, 'store'])->name('store');
});
    
