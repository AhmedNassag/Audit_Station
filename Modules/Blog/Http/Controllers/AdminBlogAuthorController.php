<?php

namespace Modules\Blog\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Requests\BlogAuthorRequest;
use Modules\Blog\Models\BlogAuthor;
use Modules\Blog\Services\AdminBlogAuthorService;
use Modules\Blog\Transformers\BlogAuthorResource;

class AdminBlogAuthorController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly AdminBlogAuthorService $adminBlogAuthorService) {}

    public function index()
    {
        $authors = $this->adminBlogAuthorService->index();

        return $this->paginatedResponse($authors, BlogAuthorResource::class);
    }

    public function show($id)
    {
        $author = $this->adminBlogAuthorService->show($id);

        return $this->okResponse(new BlogAuthorResource($author));
    }

    public function store(BlogAuthorRequest $request)
    {
        $data = $request->validated();

        $this->adminBlogAuthorService->store($data);

        return $this->createdResponse(message: translate_success_message('blog_author', 'created'));
    }

    public function update(BlogAuthorRequest $request, $id)
    {
        $data = $request->validated();

        $this->adminBlogAuthorService->update($data, $id);

        return $this->okResponse(message: translate_success_message('blog_author', 'updated'));
    }

    public function destroy($id)
    {
        BlogAuthor::query()->findOrFail($id)->delete();

        return $this->okResponse(message: translate_success_message('blog_author', 'deleted'));
    }
}
