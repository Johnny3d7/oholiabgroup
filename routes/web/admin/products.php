<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Product\NatureController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\TypeController;
use App\Http\Controllers\Admin\Product\UniteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/products')->name('products.')->group(function () {
    // Route::get('/', [ProductController::class, 'index'])->name('index');
    // Route::post('create', [ProductController::class, 'store'])->name('store');
    Route::resource('categories', CategoryController::class);

    Route::resource('types', TypeController::class);

    Route::resource('natures', NatureController::class);

    Route::resource('unites', UniteController::class);
});
Route::resource('products', ProductController::class);
