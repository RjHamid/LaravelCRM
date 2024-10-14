<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

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
Route::prefix('Order')->group(function(){
Route::post('create', [OrderController::class, 'create'])->name('create');
Route::get('index/{id?}', [OrderController::class, 'index'])->name('index');
Route::put('edit/{id}', [OrderController::class, 'edit'])->name('edit');
Route::delete('delete/{id}', [OrderController::class, 'delete'])->name('delete');
Route::get('indexn/{uniqueCode}', [OrderController::class, 'indexn'])->name('indexn'); 
});