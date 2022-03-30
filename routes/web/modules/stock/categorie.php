<?php

use App\Http\Controllers\Stock\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Categorie Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock categorie web routes for your application.
|
*/

Route::resource('categories', CategoryController::class);

// Route::get('/categories', 'ProductCategoryController@index')->name('categories_prod.index');
// Route::get('/category/create', 'ProductCategoryController@create')->name('categories.create');
// Route::post('/category/store', 'ProductCategoryController@store')->name('categories.store');
// Route::get('/category/edit/{slug}', 'ProductCategoryController@edit')->name('categories.edit');
// Route::any('/category/update/{slug}', 'ProductCategoryController@update')->name('categories.update');
// Route::get('/category/destroy/{slug}', 'ProductCategoryController@destroy')->name('categories.destroy');
