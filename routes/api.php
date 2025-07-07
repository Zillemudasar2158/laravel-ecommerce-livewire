<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/alllist',[ProductApiController::class,'list']);
Route::post('/add',[ProductApiController::class,'create']);
Route::put('/putcategory',[ProductApiController::class,'update']);
Route::delete('/catdelete/{id}',[ProductApiController::class,'delete']);
Route::get('/search/{name}',[ProductApiController::class,'search']);

Route::resource('/category',CategoryController::class);