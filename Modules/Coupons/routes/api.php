<?php

use Illuminate\Support\Facades\Route;
use Modules\Coupons\Http\Controllers\CouponController;

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

Route::prefix('coupons')->group(function (){

    Route::get('/',[CouponController::class,'index']);
    Route::get('/{coupon}',[CouponController::class,'show']);
    Route::post('/',[CouponController::class,'store']);
    Route::patch('/{coupon}',[CouponController::class,'update']);
    Route::delete('/{coupon}',[CouponController::class,'destroy']);
});
