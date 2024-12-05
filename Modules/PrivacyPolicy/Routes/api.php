<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\PrivacyPolicy\Http\Controllers\PrivacyPolicyController;
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

Route::group(['prefix' => 'admin/privacy_policy', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [PrivacyPolicyController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'privacy_policy'));

    Route::put('', [PrivacyPolicyController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'privacy_policy'));
});

Route::get('public/privacy_policy', [PrivacyPolicyController::class, 'publicShow']);
