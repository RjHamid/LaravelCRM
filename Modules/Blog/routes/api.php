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

Route::prefix('Blogs')->group(function(){

    Route::get('index',[BlogController::class,'index'])->name('index');

    Route::get('show/{blog}',[BlogController::class,'show'])->name('show');

    Route::post('store',[BlogController::class,'store'])->name('store');

    Route::patch('update/{blog}', [BlogController::class, 'update'])->name('update');

    Route::delete('delete/{blog}',[BlogController::class,'delete'])->name('delete');

});
