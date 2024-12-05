<?php

namespace Modules\Category\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Category\Services\ClientCategoryService;
use Modules\Category\Transformers\CategoryResource;

class ClientCategoryController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly ClientCategoryService $clientCategoryService) {}

    public function parentCategories()
    {
        $parentCategories = $this->clientCategoryService->parentCategories();

        return $this->paginatedResponse($parentCategories, CategoryResource::class);
    }

    public function subCategories($parentId)
    {
        $subCategories = $this->clientCategoryService->subCategories($parentId);

        return $this->paginatedResponse($subCategories, CategoryResource::class);
    }
}
