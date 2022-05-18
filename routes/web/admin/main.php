<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/


Route::prefix('/admin')->name('admin.')->group(function () {
    
        Route::prefix('/icons')->name('icons.')->group(function () {
            Route::get('/', [AdminController::class, 'iconsIndex'])->name('index');
        });
    Route::middleware(['role:admin'])->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');
    
        require('users.php');
        
        require('roles.php');
        
        require('permissions.php');
        
        require('entreprises.php');
        
        require('entrepots.php');
        
        require('employes.php');
    
        require('categories.php');
        
    });
    require('products.php');
});