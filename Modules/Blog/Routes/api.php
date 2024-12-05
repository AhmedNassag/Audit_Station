<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\AdminBlogAuthorController;
use Modules\Blog\Http\Controllers\AdminBlogController;
use Modules\Blog\Http\Controllers\PublicBlogController;

Route::group(['middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::group(['prefix' => 'admin/blogs'], function () {
        Route::get('', [AdminBlogController::class, 'index']);
        Route::post('', [AdminBlogController::class, 'store']);
        Route::get('{id}', [AdminBlogController::class, 'show']);
        Route::post('{id}', [AdminBlogController::class, 'update']);
        Route::delete('{id}', [AdminBlogController::class, 'destroy']);
    });

    Route::group(['prefix' => 'admin/blog_authors'], function () {
        Route::get('', [AdminBlogAuthorController::class, 'index']);
        Route::post('', [AdminBlogAuthorController::class, 'store']);
        Route::get('{id}', [AdminBlogAuthorController::class, 'show']);
        Route::post('{id}', [AdminBlogAuthorController::class, 'update']);
        Route::delete('{id}', [AdminBlogAuthorController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'public/blogs'], function () {
    Route::get('', [PublicBlogController::class, 'index']);
    Route::get('{id}', [PublicBlogController::class, 'show']);
});
