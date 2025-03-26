<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\NewsController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('tags', TagController::class);
        Route::resource('pages', PageController::class);
        Route::resource('blog-posts', BlogPostController::class);
        Route::resource('news', NewsController::class);

        Route::post('quill/upload', [App\Http\Controllers\Admin\QuillController::class, 'upload'])
            ->name('quill.upload');
    });
