<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;


Route::prefix('admin')->group(function () {
    // Authentication Routes
    Route::get('/login', [LoginController::class, 'create'])->name('admin.login');

    Route::post('/login', [LoginController::class, 'store'])->name('admin.store');


    // Protected Routes
    Route::middleware('auth:admin')->group(function () {

        Route::post('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'posts'], function () {

            Route::get('/view', [PostController::class, 'index'])->name('admin.posts.index');
    
            Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
    
            Route::post('/store', [PostController::class, 'store'])->name('admin.posts.store');

            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');

            Route::put('/update/{id}', [PostController::class, 'update'])->name('admin.posts.update');

            Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete');
        });
    
    });
});
