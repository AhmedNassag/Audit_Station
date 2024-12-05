<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Role\Helpers\PermissionHelper;
use Modules\Service\Http\Controllers\AdminServiceController;
use Modules\Service\Http\Controllers\PublicServiceController;

Route::group(['prefix' => 'admin/services', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [AdminServiceController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'services'));

    Route::post('', [AdminServiceController::class, 'store'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'services'));

    Route::get('{id}', [AdminServiceController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'services'));

    Route::post('{id}', [AdminServiceController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'services'));

    Route::delete('{id}', [AdminServiceController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'services'));
});

Route::group(['prefix' => 'public/services'], function () {
    Route::get('', [PublicServiceController::class, 'index']);
    Route::get('{id}', [PublicServiceController::class, 'show']);
});
