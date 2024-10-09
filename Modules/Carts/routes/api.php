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

Route::post('/Carts',[CartsController::class,'create'])->name('create');
Route::get('/Carts/{id?}', [CartsController::class, 'index'])->name('index');
Route::put('/Carts/{id}', [CartsController::class, 'edit'])->name('edit');
Route::delete('/Carts/{id}', [CartsController::class, 'delete'])->name('delete');
