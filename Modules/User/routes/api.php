<?php

use App\Http\Controllers\AddressController;
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

Route::post('verify_code',[AuthController::class,'verify_code'])->name('verify_code');

Route::post('login',[AuthController::class,'login'])->name('logine');

Route::post('logout/{id}',[AuthController::class,'logout'])->name('logout');

});

Route::prefix('User')->group(function(){

    Route::get('index/{id?}',[UserController::class,'index'])->name('index');

    Route::put('edit/{id}',[UserController::class,'edit'])->name('edit');

    Route::delete('delete/{id}',[UserController::class,'delete'])->name('delete');
});
Route::prefix('Address')->group(function(){

    Route::get('index/{user_id}',[AddressController::class,'index'])->name('index');
    
    Route::post('create',[AddressController::class,'create'])->name('create');
    
    Route::put('edit/{id}',[AddressController::class,'edit'])->name('edit');
    
    Route::delete('delete/{id}',[AddressController::class,'delete'])->name('delete');
    
    });
