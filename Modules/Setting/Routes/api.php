<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Role\Helpers\PermissionHelper;
use Modules\Setting\Http\Controllers\SettingController;

Route::group(['prefix' => 'admin/settings', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [SettingController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'setting'));

    Route::put('', [SettingController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'setting'));
});

Route::get('public/settings', [SettingController::class, 'show']);
