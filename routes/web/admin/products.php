<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NatureController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UniteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::resource('products', ProductController::class);
Route::prefix('/produits')->name('products.')->group(function () {
    // Route::get('/', [ProductController::class, 'index'])->name('index');
    // Route::post('create', [ProductController::class, 'store'])->name('store');
});

Route::prefix('/produits')->group(function () {
    Route::resource('categories', CategoryController::class);
    
    Route::resource('types', TypeController::class);
    
    Route::resource('natures', NatureController::class);
    
    Route::resource('unites', UniteController::class);
});
    
