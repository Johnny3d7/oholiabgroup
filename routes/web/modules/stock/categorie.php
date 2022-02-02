<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Stock Categorie Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module stock categorie web routes for your application.
|
*/

Route::get('/categories', 'ProductCategoryController@index')->name('categories_prod.index');
Route::get('/category/create', 'ProductCategoryController@create')->name('category_prod.create');
Route::post('/category/store', 'ProductCategoryController@store')->name('category_prod.store');
Route::get('/category/edit/{slug}', 'ProductCategoryController@edit')->name('category_prod.edit');
Route::any('/category/update/{slug}', 'ProductCategoryController@update')->name('category_prod.update');
Route::get('/category/destroy/{slug}', 'ProductCategoryController@destroy')->name('category_prod.destroy');
