<?php

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\PaymentController;

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

Route::post('/Payment', [PaymentController::class, 'create'])->name('create');
Route::get('/Payment/{id?}', [PaymentController::class, 'index'])->name('index');
Route::put('/Payment/{id}', [PaymentController::class, 'edit'])->name('edit');
Route::delete('/Payment/{id}', [PaymentController::class, 'delete'])->name('delete');
