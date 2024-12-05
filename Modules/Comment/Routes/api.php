<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\AdminCommentController;
use Modules\Comment\Http\Controllers\PublicCommentController;

Route::group(['prefix' => 'admin/comments', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [AdminCommentController::class, 'index']);
    Route::delete('{id}', [AdminCommentController::class, 'destroy']);
});

Route::get('public/comments', [PublicCommentController::class, 'index']);
Route::group(['prefix' => 'public/comments', 'middleware' => GeneralHelper::getDefaultLoggedUserMiddlewares()], function () {
    Route::post('', [PublicCommentController::class, 'store']);
    Route::patch('', [PublicCommentController::class, 'update']);
    Route::delete('', [PublicCommentController::class, 'destroy']);
});
