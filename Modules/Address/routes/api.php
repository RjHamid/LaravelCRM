<?php

use Illuminate\Support\Facades\Route;
use Modules\Address\Http\Controllers\AddressController;

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
Route::prefix('Address')->group(function(){

Route::get('index/{user_id}',[AddressController::class,'index'])->name('index');

Route::post('create',[AddressController::class,'create'])->name('create');

Route::put('edit/{id}',[AddressController::class,'edit'])->name('edit');

Route::delete('delete/{id}',[AddressController::class,'delete'])->name('delete');

});