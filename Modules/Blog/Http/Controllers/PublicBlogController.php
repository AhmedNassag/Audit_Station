<?php

namespace Modules\Blog\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Blog\Services\PublicBlogService;
use Modules\Blog\Transformers\BlogResource;

class PublicBlogController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly PublicBlogService $publicBlogService) {}

    public function index()
    {
        $blogs = $this->publicBlogService->index();

        return $this->paginatedResponse($blogs, BlogResource::class);
    }

    public function show($id)
    {
        $blog = $this->publicBlogService->show($id);

        return $this->resourceResponse(BlogResource::make($blog));
    }
}
