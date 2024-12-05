<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\AdminParentCategoryController;
use Modules\Category\Http\Controllers\AdminSubCategoryController;
use Modules\Category\Http\Controllers\ClientCategoryController;
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

Route::group(['prefix' => 'admin', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::group(['prefix' => 'parent_categories'], function () {
        Route::get('', [AdminParentCategoryController::class, 'index'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'parent_category'));

        Route::get('{id}', [AdminParentCategoryController::class, 'show'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'parent_category'));

        Route::post('', [AdminParentCategoryController::class, 'store'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'parent_category'));

        Route::post('{id}', [AdminParentCategoryController::class, 'update'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'parent_category'));

        Route::delete('{id}', [AdminParentCategoryController::class, 'destroy'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'parent_category'));
    });

    Route::group(['prefix' => 'sub_categories'], function () {
        Route::get('', [AdminSubCategoryController::class, 'index'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'sub_category'));

        Route::get('{id}', [AdminSubCategoryController::class, 'show'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'sub_category'));

        Route::post('', [AdminSubCategoryController::class, 'store'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'sub_category'));

        Route::post('{id}', [AdminSubCategoryController::class, 'update'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'sub_category'));

        Route::delete('{id}', [AdminSubCategoryController::class, 'destroy'])
            ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'sub_category'));
    });
});

Route::group(['prefix' => 'clients/parent_categories'], function () {
    Route::get('', [ClientCategoryController::class, 'parentCategories']);
    Route::get('{parentId}/sub_categories', [ClientCategoryController::class, 'subCategories']);
});
