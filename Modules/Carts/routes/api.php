<?php

use Illuminate\Support\Facades\Route;
use Modules\Carts\Http\Controllers\CartsController;

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
Route::prefix('Carts')->group(function(){
Route::post('create',[CartsController::class,'create'])->name('create');
Route::get('index/{id?}', [CartsController::class, 'index'])->name('index');
Route::put('edit/{id}', [CartsController::class, 'edit'])->name('edit');
Route::delete('delete/{id}', [CartsController::class, 'delete'])->name('delete');
Route::get('indexn/{userId}', [CartsController::class, 'indexn'])->name('indexn');
Route::get('indexz/{userId}/{status}', [CartsController::class, 'indexz'])->name('indexz');
});