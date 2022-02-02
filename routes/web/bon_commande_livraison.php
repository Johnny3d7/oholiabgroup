<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bon Commande & Livraison Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register bon commande & livraison web routes for your application.
|
*/


//Les routes des bons de commande et de livraison
Route::get('/boncommandeoholiab', 'App\Http\Controllers\Stock\CommandeFournisseurController@boncommandeoholiab')->name('boncommandeoholiab');
Route::get('/boncommandeakebie', 'App\Http\Controllers\Stock\CommandeFournisseurController@boncommandeakebie')->name('boncommandeakebie');
Route::get('/boncommandeobp', 'App\Http\Controllers\Stock\CommandeFournisseurController@boncommandeobp')->name('boncommandeobp');
Route::get('/bonlivraisonoholiab', 'App\Http\Controllers\Stock\LivraisonController@bonlivraisonoholiab')->name('bonlivraisonoholiab');
Route::get('/bonlivraisonakebie', 'App\Http\Controllers\Stock\LivraisonController@bonlivraisonakebie')->name('bonlivraisonakebie');
Route::get('/bonlivraisonobp', 'App\Http\Controllers\Stock\LivraisonController@bonlivraisonobp')->name('bonlivraisonobp');