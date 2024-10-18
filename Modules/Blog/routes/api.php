<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

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

Route::prefix('Blog')->group(function(){

    Route::get('index{id?}',[BlogController::class,'index'])->name('index');

    Route::post('store',[BlogController::class,'store'])->name('store');

    Route::put('update/{Blog}', [BlogController::class, 'update'])->name('update');

    Route::delete('delete/{id}',[BlogController::class,'delete'])->name('delete');

});
