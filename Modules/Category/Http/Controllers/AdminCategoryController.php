<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Category\Models\Category;

class AdminCategoryController extends Controller
{
    use HttpResponse;

    public function changeStatus(StatusRequest $request, $id): JsonResponse
    {
        $category = Category::query()->findOrFail($id);

        $category->update(['status' => $request->status]);

        return $this->okResponse(message: translate_success_message('category', 'updated'));
    }
}
