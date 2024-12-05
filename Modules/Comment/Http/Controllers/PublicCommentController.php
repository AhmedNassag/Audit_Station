<?php

namespace Modules\Comment\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Comment\Http\Requests\CommentFilterRequest;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Comment\Services\PublicCommentService;
use Modules\Comment\Transformers\CommentResource;

class PublicCommentController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly PublicCommentService $publicCommentService) {}

    public function index(CommentFilterRequest $request)
    {
        $comments = $this->publicCommentService->index($request->validated());

        return $this->paginatedResponse($comments, CommentResource::class);
    }

    public function store(CommentRequest $request): JsonResponse
    {
        $this->publicCommentService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('comment', 'created'));
    }

    public function update(CommentRequest $request)
    {
        $this->publicCommentService->update($request->validated());

        return $this->okResponse(message: translate_success_message('comment', 'updated'));
    }

    public function destroy()
    {
        $this->publicCommentService->destroy(request()->input('id'));

        return $this->okResponse(message: translate_success_message('comment', 'deleted'));
    }
}
