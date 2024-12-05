<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Role\Helpers\PermissionHelper;
use Modules\TermsAndConditions\Http\Controllers\TermConditionController;

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

Route::group(['prefix' => 'terms_and_conditions', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [TermConditionController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'terms_and_conditions'));

    Route::put('', [TermConditionController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'terms_and_conditions'));

});

Route::get('public/terms_and_conditions', [TermConditionController::class, 'show']);
