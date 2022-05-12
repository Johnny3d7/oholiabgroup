<?php

use App\Http\Controllers\Admin\EmployeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/employes')->name('employes.')->group(function () {
    Route::get('/', [EmployeController::class, 'index'])->name('index');
    Route::post('create', [EmployeController::class, 'store'])->name('store');
});
