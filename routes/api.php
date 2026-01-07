<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('register',[UserController::class,'register'])->name('register');
// Route::post('login',[UserController::class,'login'])->name('login');


// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('posts', PostController::class);
//     Route::get('/trashed',[PostController::class,'showTrashed']);
//     Route::post('/restore/{id}',[PostController::class,'restorePost']);
//     Route::delete('/force-delete/{id}',[PostController::class,'forceDeletePost']);
//     Route::post('logout',[UserController::class,'logout'])->name('logout');
// });
