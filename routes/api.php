<?php
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('Rating')->group(function(){
    Route::post('create',[RatingController::class,'create'])->name('create');
    Route::get('index/{id?}',[RatingController::class,'index'])->name('index');
    Route::put('edit/{id}',[RatingController::class,'edit'])->name('edit');
    Route::delete('delete/{id}',[RatingController::class,'delete'])->name('delete');
});
