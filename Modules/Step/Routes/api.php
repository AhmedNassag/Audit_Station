<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Role\Helpers\PermissionHelper;
use Modules\Step\Http\Controllers\StepController;

Route::group(['prefix' => 'admin/steps', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('/', [StepController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'steps'));

    Route::post('/', [StepController::class, 'store'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'steps'));

    Route::get('/{id}', [StepController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'steps'));

    Route::post('/{id}', [StepController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'steps'));

    Route::delete('/{id}', [StepController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'steps'));
});

Route::get('public/steps', [StepController::class, 'index']);
