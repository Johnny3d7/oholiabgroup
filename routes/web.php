<?php

use App\Http\Controllers;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('main.dashboard.dashboard');
});*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/mail', 'App\Http\Controllers\Stock\ProductCategoryController@mail')->name('mail');

Route::middleware(['guest'])->group(function(){
    Route::view('login', 'main.user.login')->name('login');
    Route::view('/register', '')->name('register');
    Route::post('/checkuser', [App\Http\Controllers\User\UserController::class, 'checkuser'])->name('checkuser');
});

Route::middleware(['auth','route-stack'])->group(function(){
    Route::get('read-all-notifications', function () {
        $notifications = \Auth::user()->notifs();
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return back();
    })->name('markAllAsRead');

    Route::post('set-sidebar-compact', function () {
        if(session('sidebar-compact')) 
            session()->forget('sidebar-compact');
        else
            session(['sidebar-compact' => true]);
    })->name('set-sidebar-compact');

    Route::prefix('mon-compte')->name('profile.')->group(function () {
        Route::get('/', [UserController::class, 'mon_compte'])->name('index');
        Route::post('general', [UserController::class, 'update'])->name('update');
        Route::post('password', [UserController::class, 'password'])->name('password');
    });

    //Liste des modules
    require('web/modules/main.php');

    //Les routes des bons de commande et de livraison
    require('web/bon_commande_livraison.php');

    //Akébié routes
    require('web/akebie/main.php');

    //Obp Inc routes
    require('web/obpinc/main.php');


    //connexion
    Route::get('/slogin', 'App\Http\Controllers\Stock\DashboardController@loguser')->name('user.login');

    //commande client
    require('web/commande_client.php');

    //Bon de commande
    require('web/bon_de_commande.php');

    //expression de besoin
    Route::get('/expression_besoin', 'App\Http\Controllers\Stock\CommandeController@expressionbesoin')->name('expression_besoin.index');

    //Commande fournisseur
    require('web/commande_fournisseur.php');

    //Facture
    Route::get('/factures', 'App\Http\Controllers\Stock\FactureController@index')->name('facture.index');

    //Livraison
    Route::get('/livraisons', 'App\Http\Controllers\Stock\LivraisonController@index')->name('livraison.index');
    Route::get('commande-nature/{id}', 'App\Http\Controllers\Stock\AjaxController@getCommandeNature')->name('commande-nature.search');

    //Bon de livraison

    //Créer bon de livraison
    Route::post('/commande-client/create-bon-livraison', 'App\Http\Controllers\Stock\LivraisonController@creer_bonlivraison')->name('commande_client.create_bon_livraison');

    //Gestion de stock routes
    require('web/modules/stock/main.php');

    // Administration Module routes
    require('web/admin/main.php');

    // Achats
    require('web/modules/achat/main.php');

    // Parc Info
    require('web/modules/parc-info/main.php');

    // Parc Auto
    require('web/modules/parc-auto/main.php');
});

Route::get('back', function () {
    $array = session('routeStack');
    try {
        /* Double pop because the current have to be deleted (but the previous would be pushed onto the current) */
        $route = array_pop($array); $route = array_pop($array);
    } catch (\Throwable $th) {
        $route = null;
    }

    session(['routeStack' => $array]);

    return redirect()->route(is_array($route) ? $route['name'] : 'modules.index', is_array($route) ? $route['params'] : null);
})->name('backStack');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::fallback(function(){
    return back();
    return redirect()->route('backStack');
});

// Route::view('/parcauto', 'main.parcauto.index')->name('parcauto.index');
// Route::view('/parcinfo', 'main.parcinfo.index')->name('parcinfo.index');
// Route::view('/achat', 'main.achats.index')->name('achats.index');
// Route::view('/ressourceh', 'main.ressourceh.index')->name('ressourceh.index');
