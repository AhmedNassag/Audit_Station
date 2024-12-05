<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Role\Helpers\PermissionHelper;
use Modules\Section\Http\Controllers\AdminSectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin/sections', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [AdminSectionController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'section'));

    Route::post('', [AdminSectionController::class, 'store'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'section'));

    Route::get('{id}', [AdminSectionController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'section'));

    Route::put('{id}', [AdminSectionController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'section'));

    Route::delete('{id}', [AdminSectionController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'section'));
});
