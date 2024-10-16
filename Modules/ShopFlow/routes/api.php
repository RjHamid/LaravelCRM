<?php

use Illuminate\Support\Facades\Route;
use Modules\ShopFlow\Http\Controllers\CartController;
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

    Route::post('{product}',[CartController::class,'store']);
    Route::patch('{cart}',[CartController::class,'update']);
    Route::delete('{cart}',[CartController::class,'destroy']);

});
