<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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



Auth::routes();



Route::get('/', function () {
    return view('backend.pages.login');
});


Route::group(['prefix' => 'admin'], function(){

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('roles','App\Http\Controllers\backend\RolesController');
});
