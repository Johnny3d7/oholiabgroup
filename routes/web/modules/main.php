<?php

use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Modules Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register modules web routes for your application.
| Only shared routes are registered here, specific ones are inside dir.
|
*/


//Liste des modules
Route::middleware('auth')->group(function(){
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
});
