<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});


// Route::get('/posts',[PostController::class,'displayPage'])->name('posts.');
// Route::get('/posts',[PostController::class,'index'])->name('posts');
// Route::get('/posts/{id}',[PostController::class,'show'])->name('posts');
// Route::get('/posts/trash',[PostController::class,'showTrashed'])->name('posts');


// 🟢 عرض البوستات النشطة (Index)
    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');

    // 🟡 عرض البوستات المحذوفة (Trashed)
    Route::get('/posts/trashed', [PostController::class, 'showTrashed'])
        ->name('posts.trashed');

    // 🔵 عرض بوست واحد (Show)
    Route::get('/posts/{id}', [PostController::class, 'show'])
        ->name('posts.show');
