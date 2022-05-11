<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/produits')->name('products.')->group(function () {
    Route::resource('/', ProductController::class);
    // Route::get('/', [ProductController::class, 'index'])->name('index');
    // Route::post('create', [ProductController::class, 'store'])->name('store');
});
    
