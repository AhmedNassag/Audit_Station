<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Faqs\Http\Controllers\FaqsController;
use Modules\Role\Helpers\PermissionHelper;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::group(['prefix' => 'admin/faqs', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [FaqsController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'faqs'));

    Route::get('{id}', [FaqsController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'faqs'));

    Route::post('', [FaqsController::class, 'store'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'faqs'));

    Route::put('{id}', [FaqsController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'faqs'));

    Route::delete('{id}', [FaqsController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'faqs'));
});

Route::get('public/faqs', [FaqsController::class, 'index']);
