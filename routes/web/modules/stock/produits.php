<?php

// use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Stock\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Produit Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock produit web routes for your application.
|
*/

// Routes Produits
// Route::get('products', [App\Http\Controllers\Stock\ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);
// Route::get('/products', 'ProductController@index')->name('products.index');
// Route::get('/product/create', 'ProductController@create')->name('product.create');
// Route::get('/product/show/{slug}', 'ProductController@show')->name('product.show');
// Route::post('/product/store', 'ProductController@store')->name('product.store');
// Route::get('/product/edit/{slug}', 'ProductController@edit')->name('product.edit');
// Route::any('/product/update/{slug}', 'ProductController@update')->name('product.update');
// Route::get('/product/destroy/{slug}', 'ProductController@destroy')->name('product.destroy');

//Ajouter une image au produit
Route::post('/add_image/product', 'ProductController@addImage')->name('products.add_image');
