<?php

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

Route::get('/categories', function () {
    return "Categories";
})->name('categories');

Route::get('/channels', function () {
    return "Channels";
})->name('channels');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
