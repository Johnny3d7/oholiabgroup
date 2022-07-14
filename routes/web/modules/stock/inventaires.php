<?php

// use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Stock\InventaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Inventaire Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock produit web routes for your application.
|
*/

// Routes Inventaires
Route::resource('inventaires', InventaireController::class);
