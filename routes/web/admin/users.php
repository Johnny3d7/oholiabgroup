<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module ParcAuto Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register module parcinfo web routes for your application.
|
*/

Route::resource('users', UserController::class);
Route::prefix('/users')->name('users.')->group(function () {
    // Route::get('/', [UserController::class, 'index'])->name('index');
    // Route::get('create', [UserController::class, 'usersCreate'])->name('create');
    // Route::post('store', [UserController::class, 'store'])->name('store');
    // Route::get('show/{user}', [UserController::class, 'show'])->name('show');
});
