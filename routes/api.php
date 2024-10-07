<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('Order')->group(function(){
    Route::post('create',[OrderController::class],'create')->name('create');
    Route::get('index/{id?}',[OrderController::class],'index')->name('index');
    Route::put('edit/{id}',[OrderController::class],'edit')->name('edit');
    Route::delete('delete',[OrderController::class],'delete')->name('delete');
});