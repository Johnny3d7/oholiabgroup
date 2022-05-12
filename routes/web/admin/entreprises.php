<?php

use App\Http\Controllers\Admin\EntrepriseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/entreprises')->name('entreprises.')->group(function () {
    Route::get('/', [EntrepriseController::class, 'index'])->name('index');
    Route::post('create', [EntrepriseController::class, 'store'])->name('store');
});
    