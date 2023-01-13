<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ExpeditionController;

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

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group([
    'prefix' => 'item'
], function ($router) {
    Route::get('/all', [ItemController::class, 'all']);
    Route::post('/byCategory', [ItemController::class, 'by_category']);
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    Route::group([
        'prefix' => 'user'
    ], function ($router) {
        Route::get('/detail', UserController::class);
    });

    Route::group([
        'prefix' => 'cart'
    ], function ($router) {
        Route::post('/add', [CartController::class, 'add']);
        Route::get('/show', [CartController::class, 'show']);
    });

    Route::group([
        'prefix' => 'order'
    ], function ($router) {
        Route::post('/checkout', CheckoutController::class);
    });

    Route::group([
        'prefix' => 'expedition'
    ], function ($router) {
        Route::get('/all',ExpeditionController::class);
    });
});