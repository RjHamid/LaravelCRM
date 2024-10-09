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

Route::post('/Order', [OrderController::class, 'create'])->name('create');
Route::get('/Order/{id?}', [OrderController::class, 'index'])->name('index');
Route::put('/Order/{id}', [OrderController::class, 'edit'])->name('edit');
Route::delete('/Order/{id}', [OrderController::class, 'delete'])->name('delete');
