<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxTagController;
Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');

Route::get('/', [PostController::class, 'show']);
Route::middleware('auth')->group(function(){
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('posts/add', [PostController::class, 'view'])->name('posts.add');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{id}/edit', [PostController::class, 'edit']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::get('/more/{id}', [PostController::class, 'more']);
    
    
    Route::resource('users', UserController::class);
    Route::get('users/{id}/posts', [UserController::class, 'posts'])->name('user.posts');
    
    Route::resource('tags', TagController::class);
    Route::resource('ajax-tags', AjaxTagController::class);

});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
