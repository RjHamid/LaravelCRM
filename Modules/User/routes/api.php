<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\UserController;

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

Route::prefix('Auth')->group(function(){

Route::post('register',[AuthController::class,'register'])->name('register');

Route::post('login_v1',[AuthController::class,'login_v1'])->name('login_v1');

Route::post('login_v2',[AuthController::class,'login_v2'])->name('login_v2');

Route::post('login_request', [AuthController::class,'login_request'])->name('login_request');

Route::post('email_request',[AuthController::class,'email_request'])->name('email_request');

Route::post('login_code',[AuthController::class,'login_code'])->name('login_code');

Route::post('email_code',[AuthController::class,'email_code'])->name('email_code');

Route::post('logout',[AuthController::class,'logout'])->name('logout');

});
