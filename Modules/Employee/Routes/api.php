<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\EmployeeController;

Route::group(['prefix' => 'admin/admin_employees', 'middleware' => GeneralHelper::adminMiddlewares()], function () {
    Route::get('', [EmployeeController::class, 'index']);
    Route::get('{id}', [EmployeeController::class, 'show']);
    Route::post('', [EmployeeController::class, 'store']);
    Route::post('{id}', [EmployeeController::class, 'update']);
    Route::delete('{id}', [EmployeeController::class, 'destroy']);
});
