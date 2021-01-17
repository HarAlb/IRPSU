<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DrugController;
use App\Http\Controllers\Admin\SubstanceController;

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

// Route::get('/', '');

Route::group( ['prefix' => ''], function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();
});



Route::group(['prefix' => 'admin' , 'middleware' => ['auth' , 'is_admin'] ] , function (){
    Route::get('' , [AdminController::class , 'index']);
    Route::resource('drugs', DrugController::class);
    Route::resource('substances', SubstanceController::class);
});



