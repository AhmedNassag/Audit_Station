<?php

namespace Modules\Comment\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Comment\Http\Requests\CommentFilterRequest;
use Modules\Comment\Models\Comment;
use Modules\Comment\Services\AdminCommentService;
use Modules\Comment\Transformers\CommentResource;

class AdminCommentController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly AdminCommentService $adminCommentService) {}

    public function index(CommentFilterRequest $request)
    {
        $comments = $this->adminCommentService->index($request->validated());

        return $this->paginatedResponse($comments, CommentResource::class);
    }

    public function destroy($id)
    {
        Comment::query()->findOrFail($id)->delete();

        return $this->okResponse(message: translate_success_message('comment', 'deleted'));
    }
}
