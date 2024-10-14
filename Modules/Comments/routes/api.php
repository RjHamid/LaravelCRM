<?php

use Illuminate\Support\Facades\Route;
use Modules\Comments\Http\Controllers\CommentsController;

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

Route::prefix('comments')->group(function (){
    Route::get('/{type}/published',[CommentsController::class,'IndexP']);
    Route::get('/{type}/not-published',[CommentsController::class,'IndexN']);
    Route::post('/{type}/{id}',[CommentsController::class,'store']);
    Route::patch('/{comment}',[CommentsController::class,'update']);
    Route::get('/{comment}',[CommentsController::class,'show']);
    Route::delete('/{comment}',[CommentsController::class,'destroy']);
});
