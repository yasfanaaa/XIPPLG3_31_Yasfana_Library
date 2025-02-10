<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User2Controller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class,'index']);
Route::apiResource('/store', CategoryController::class);

Route::post('/user2', [User2Controller::class, 'store']);
Route::get('/user2/{id}', [User2Controller::class, 'show']);
Route::delete('/user2/{id}', [User2Controller::class, 'destroy']);
Route::put('/user2/{id}', [User2Controller::class, 'update']);