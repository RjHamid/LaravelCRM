<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('Order')->group(function(){
    Route::post('create',[OrderController::class],'create')->name('create');
    Route::get('index/{id?}',[OrderController::class],'index')->name('index');
    Route::put('edit/{id}',[OrderController::class],'edit')->name('edit');
    Route::delete('delete',[OrderController::class],'delete')->name('delete');
});
Route::prefix('Carts')->group(function(){
    Route::post('create',[CartsController::class],'create')->name('create');
    Route::get('index/{id?}',[CartsController::class],'index')->name('index');
    Route::put('edit/{id}',[CartsController::class],'edit')->name('edit');
    Route::delete('delete',[CartsController::class],'delete')->name('delete');
});
Route::prefix('Payment')->group(function(){
    Route::post('create',[PaymentController::class],'create')->name('create');
    Route::get('index/{id?}',[PaymentController::class],'index')->name('index');
    Route::put('edit/{id}',[PaymentController::class],'edit')->name('edit');
    Route::delete('delete',[PaymentController::class],'delete')->name('delete');
});
Route::prefix('Rating')->group(function(){
    Route::post('create',[RatingController::class],'create')->name('create');
    Route::get('index/{id?}',[RatingController::class],'index')->name('index');
    Route::put('edit/{id}',[RatingController::class],'edit')->name('edit');
    Route::delete('delete',[RatingController::class],'delete')->name('delete');
});
