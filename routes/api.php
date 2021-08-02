<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Category
Route::apiResource('categories', CategoryController::class);
Route::prefix('categories')->group(function () {
    Route::get('/{name}/channels', [CategoryController::class, 'channelsByName']);
});

// Channel
Route::apiResource('channels', ChannelController::class);
Route::get('/channels/name/{channel_name}', [ChannelController::class, 'showByName']);



// Comment
Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{channel_id}', [CommentController::class, 'show']);
    Route::get('/name/{channel_name}', [CommentController::class, 'showByName']);
    Route::delete('/{channel_id}', [CommentController::class, 'destroy']);

});

// Search
Route::prefix('search/{name}')->group(function () {
    Route::get('/', [SearchController::class, 'index']);
});
