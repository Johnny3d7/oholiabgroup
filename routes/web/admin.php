<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'usersIndex'])->name('index');
        Route::get('create', [AdminController::class, 'usersCreate'])->name('create');
        Route::post('store', [AdminController::class, 'usersStore'])->name('store');
    });
    
    Route::prefix('/roles')->name('roles.')->group(function () {
        Route::get('/', [AdminController::class, 'rolesIndex'])->name('index');
        Route::post('create', [AdminController::class, 'rolesStore'])->name('store');
    });
    
    Route::prefix('/permissions')->name('permissions.')->group(function () {
        Route::get('/', [AdminController::class, 'permissionsIndex'])->name('index');
        Route::post('create', [AdminController::class, 'permissionsStore'])->name('store');
    });
    
    Route::prefix('/entreprises')->name('entreprises.')->group(function () {
        Route::get('/', [AdminController::class, 'rolesIndex'])->name('index');
        Route::post('create', [AdminController::class, 'rolesStore'])->name('store');
    });
    
    Route::prefix('/employes')->name('employes.')->group(function () {
        Route::get('/', [AdminController::class, 'usersIndex'])->name('index');
        Route::post('create', [AdminController::class, 'rolesStore'])->name('store');
    });
    
    Route::prefix('/entrepots')->name('entrepots.')->group(function () {
        Route::get('/', [AdminController::class, 'entrepotsIndex'])->name('index');
        Route::post('create', [AdminController::class, 'entrepotsStore'])->name('store');
    });
    
    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', [AdminController::class, 'categoriesIndex'])->name('index');
        Route::post('create', [AdminController::class, 'categoriesStore'])->name('store');
    });
    
    Route::prefix('/produits')->name('products.')->group(function () {
        Route::get('/', [AdminController::class, 'rolesIndex'])->name('index');
        Route::post('create', [AdminController::class, 'rolesStore'])->name('store');
    });
    
    Route::prefix('/icons')->name('icons.')->group(function () {
        Route::get('/', [AdminController::class, 'iconsIndex'])->name('index');
    });
});