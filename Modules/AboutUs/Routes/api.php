<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\AboutUs\Http\Controllers\AboutUsController;
use Modules\Role\Helpers\PermissionHelper;

//Route::prefix('admin/about_us')->group(function () {
//    Route::get('', [AboutUsController::class,'show']);
//    Route::post('', [AboutUsController::class, 'update']);
//});

// ['auth:sanctum', 'user_type_in:'. UserTypeEnum::ADMIN_EMPLOYEE.'|'.UserTypeEnum::ADMIN]
Route::group(['prefix' => 'admin/about_us', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [AboutUsController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'about_us'));

    Route::post('', [AboutUsController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'about_us'));
});

Route::get('public/about_us', [AboutUsController::class, 'show']);
