<?php

namespace Modules\Category\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Requests\SubCategoryRequest;
use Modules\Category\Models\Category;
use Modules\Category\Services\AdminSubCategoryService;
use Modules\Category\Transformers\CategoryResource;

class AdminSubCategoryController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly AdminSubCategoryService $adminSubCategoryService) {}

    public function index()
    {
        $parentId = request()->input('parent_id');
        $subCategories = $this->adminSubCategoryService->index($parentId);

        return $this->paginatedResponse($subCategories, CategoryResource::class);
    }

    public function show($id)
    {
        $subCategory = $this->adminSubCategoryService->show($id);

        return $this->resourceResponse(CategoryResource::make($subCategory));
    }

    public function store(SubCategoryRequest $request)
    {
        $this->adminSubCategoryService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('sub_category', 'created'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $this->adminSubCategoryService->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('sub_category', 'updated'));
    }

    public function destroy($id)
    {
        Category::query()
            ->whereNotNull('parent_id')
            ->findOrFail($id)
            ->delete();

        return $this->okResponse(message: translate_success_message('sub_category', 'deleted'));
    }
}
