<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChannelController;
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



//Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::resource('channels', ChannelController::class);
Route::resource('categories', CategoryController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
