<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\ContactUs\Http\Controllers\ContactUsController;
use Modules\Role\Helpers\PermissionHelper;

Route::group(['prefix' => 'admin/contact_us', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('/', [ContactUsController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'contact_us'));

    Route::get('/{id}', [ContactUsController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'contact_us'));

    Route::delete('/{id}', [ContactUsController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'contact_us'));
});

Route::post('public/contact_us', [ContactUsController::class, 'store']);
