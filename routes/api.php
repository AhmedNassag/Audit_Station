<?php

use App\Http\Controllers\SelectMenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'select_menu'], function () {
    Route::get('blog_authors', [SelectMenuController::class, 'authors']);
    Route::get('permissions', [SelectMenuController::class, 'permissions']);
    Route::get('roles', [SelectMenuController::class, 'roles']);
    Route::get('sections', [SelectMenuController::class, 'sections']);
    Route::get('parent_categories', [SelectMenuController::class, 'parentCategories']);
    Route::get('parent_categories/{parentId}/sub_categories', [SelectMenuController::class, 'subCategories']);
});
