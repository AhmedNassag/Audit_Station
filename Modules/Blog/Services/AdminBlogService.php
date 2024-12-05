<?php

namespace Modules\Blog\Services;

use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\Builders\BlogBuilder;
use Modules\Category\Services\CategoryService;

class AdminBlogService
{
    public function __construct(
        private readonly AdminBlogAuthorService $adminBlogAuthorService,
        private readonly CategoryService $categoryService,
    ) {}

    public function index()
    {
        return Blog::query()
            ->latest()
            ->when(true, fn (BlogBuilder $b) => $b->withMinimalAdminDetails())
            ->searchable(['title'])
            ->paginatedCollection();
    }

    public function show($id)
    {
        return Blog::query()
            ->when(true, fn (BlogBuilder $b) => $b->withAdminDetails())
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        $this->adminBlogAuthorService->exists($data['blog_author_id']);
        $this->categoryService->exists($data['category_id']);

        DB::transaction(function () use ($data) {
            $blog = Blog::create($data);
            $imageService = new ImageService($blog, $data);
            $imageService->storeOneMediaFromRequest('blog_image', 'image');
        });
    }

    public function update(array $data, $id)
    {
        $blog = Blog::query()->findOrFail($id);

        if (isset($data['blog_author_id'])) {
            $this->adminBlogAuthorService->exists($data['blog_author_id']);
        }

        if (isset($data['category_id'])) {
            $this->categoryService->exists($data['category_id']);
        }

        DB::transaction(function () use ($data, $blog) {
            $blog->update($data);
            $imageService = new ImageService($blog, $data);
            $imageService->updateOneMedia('blog_image', 'image');
        });
    }
}
