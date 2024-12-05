<?php

namespace Modules\Blog\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Requests\BlogRequest;
use Modules\Blog\Models\Blog;
use Modules\Blog\Services\AdminBlogService;
use Modules\Blog\Transformers\BlogResource;

class AdminBlogController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly AdminBlogService $adminBlogService) {}

    public function index()
    {
        $blogs = $this->adminBlogService->index();

        return $this->paginatedResponse($blogs, BlogResource::class);
    }

    public function show($id)
    {
        $blog = $this->adminBlogService->show($id);

        return $this->resourceResponse(BlogResource::make($blog));
    }

    public function store(BlogRequest $request)
    {
        $this->adminBlogService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('blog', 'created_female'));
    }

    public function update(BlogRequest $request, $id)
    {
        $this->adminBlogService->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('blog', 'updated_female'));
    }

    public function destroy($id)
    {
        Blog::query()->findOrFail($id)->delete();

        return $this->okResponse(message: translate_success_message('blog', 'deleted_female'));
    }
}
