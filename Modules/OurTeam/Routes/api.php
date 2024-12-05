<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\OurTeam\Http\Controllers\AdminOurTeamController;
use Modules\OurTeam\Http\Controllers\PublicOurTeamController;
use Modules\Role\Helpers\PermissionHelper;

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

Route::group(['prefix' => 'admin/our_team', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [AdminOurTeamController::class, 'index'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('all', 'our_team'));

    Route::post('', [AdminOurTeamController::class, 'store'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('store', 'our_team'));

    Route::get('{id}', [AdminOurTeamController::class, 'show'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('show', 'our_team'));

    Route::post('{id}', [AdminOurTeamController::class, 'update'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('update', 'our_team'));

    Route::delete('{id}', [AdminOurTeamController::class, 'destroy'])
        ->middleware(PermissionHelper::getPermissionNameMiddleware('delete', 'our_team'));
});

Route::get('public/our_team', [PublicOurTeamController::class, 'index']);
