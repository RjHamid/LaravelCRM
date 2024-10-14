<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductSuiteManager\Http\Controllers\CategoryController;
use Modules\ProductSuiteManager\Http\Controllers\ProductController;
use Modules\ProductSuiteManager\Http\Controllers\ProductDiscountController;
use Modules\ProductSuiteManager\Http\Controllers\ProductGalloryController;
use App\Http\Controllers\RatingController;
use Modules\ProductSuiteManager\Http\Controllers\ProductSuiteManagerController;

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

Route::prefix('categories')->group(function (){
    Route::get('',[CategoryController::class, 'index']);
    Route::get('/{category}',[CategoryController::class, 'show']);
    Route::post('',[CategoryController::class, 'store']);
    Route::patch('/{category}',[CategoryController::class, 'update']);
    Route::delete('/{category}',[CategoryController::class, 'destroy']);
    Route::get('/type/{type}',[CategoryController::class, 'CategoryTypes']);
});

Route::prefix('products')->group(function (){
    Route::get('',[ProductController::class, 'index']);
    Route::get('/{product}',[ProductController::class, 'show']);
    Route::post('',[ProductController::class, 'store']);
    Route::patch('/{product}',[ProductController::class, 'update']);
    Route::delete('/{product}',[ProductController::class, 'destroy']);
    Route::get('index/discounts',[ProductDiscountController::class,'ProductWithDiscountIndex']);
    Route::post('/{product}/discount',[ProductDiscountController::class ,'store']);
    Route::get('/{product}/galleries',[ProductGalloryController::class, 'index']);
    Route::post('/{product}/galleries',[ProductGalloryController::class, 'store']);
    Route::delete('/{product}/galleries/{gallery}',[ProductGalloryController::class, 'destroy'])
    ->scopeBindings();
});
Route::prefix('Rating')->group(function(){
    Route::post('create',[RatingController::class,'create'])->name('create');
    Route::get('index/{id?}',[RatingController::class,'index'])->name('index');
    Route::put('edit/{id}',[RatingController::class,'edit'])->name('edit');
    Route::delete('delete/{id}',[RatingController::class,'delete'])->name('delete');
});
