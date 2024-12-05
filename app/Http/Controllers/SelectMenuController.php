<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Modules\Blog\Models\BlogAuthor;
use Modules\Blog\Transformers\BlogAuthorResource;
use Modules\Category\Models\Builders\CategoryBuilder;
use Modules\Category\Models\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;
use Modules\Role\Transformers\PermissionResource;
use Modules\Role\Transformers\RoleResource;
use Modules\Section\Entities\Section;
use Modules\Section\Transformers\SectionResource;

class SelectMenuController extends Controller
{
    use HttpResponse;

    public function permissions(): JsonResponse
    {
        $permissions = Permission::query()
            ->latest()
            ->get(['id', 'name']);

        return $this->resourceResponse(PermissionResource::collection($permissions));
    }

    public function roles()
    {
        return $this->resourceResponse(
            RoleResource::collection(
                Role::latest()
                    ->where('id', '<>', 1)
                    ->get(['id', 'name'])
            )
        );
    }

    public function authors()
    {
        return $this->resourceResponse(BlogAuthorResource::collection(BlogAuthor::query()->latest()->get(['id', 'name'])));
    }

    public function parentCategories()
    {
        $onlyHasSubCategories = (bool) request()->input('only_has_sub_categories', true);

        return $this->resourceResponse(
            CategoryResource::collection(
                Category::query()
                    ->when($onlyHasSubCategories, fn (CategoryBuilder $query) => $query->has('subCategories'))
                    ->latest()
                    ->whereNull('parent_id')
                    ->where('status', true)
                    ->get(['id', 'name'])
            )
        );
    }

    public function subCategories($parentId)
    {
        return $this->resourceResponse(
            CategoryResource::collection(
                Category::query()
                    ->latest()
                    ->whereNotNull('parent_id')
                    ->where('status', true)
                    ->where('parent_id', $parentId)
                    ->get(['id', 'name'])
            )

        );
    }

    public function sections()
    {
        return $this->resourceResponse(
            SectionResource::collection(
                Section::query()->latest()->get(['id', 'title']),
            )
        );
    }
}
