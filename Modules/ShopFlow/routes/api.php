<?php

use Illuminate\Support\Facades\Route;
use Modules\ShopFlow\Http\Controllers\CartController;
use Modules\ShopFlow\Http\Controllers\OrderController;
use Modules\ShopFlow\Http\Controllers\ShopFlowController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('carts')->group(function (){
    Route::get('',[CartController::class,'index']);
    Route::post('{product}',[CartController::class,'store']);
    Route::patch('{cart}',[CartController::class,'update']);
    Route::delete('{cart}',[CartController::class,'destroy']);
});

Route::prefix('orders')->group(function (){

    Route::get('/',[OrderController::class,'index']);
    Route::get('/userOrders',[OrderController::class,'indexU']);
    Route::get('/callback',[OrderController::class,'callback']);
    Route::get('/{order}',[OrderController::class,'show']);
    Route::post('/',[OrderController::class,'store']);
    Route::patch('/{order}',[OrderController::class,'update']);


});
