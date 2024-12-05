<?php

namespace Modules\Comment\Services;

use App\Exceptions\ValidationErrorsException;
use Modules\Blog\Services\PublicBlogService;
use Modules\Comment\Enums\CommentTypeEnum;
use Modules\Comment\Exceptions\CommentException;
use Modules\Comment\Models\Comment;

class PublicCommentService extends BaseCommentService
{
    public function index(array $filters = [])
    {
        return $this->baseIndex($filters)->paginatedCollection();
    }

    public function store(array $data)
    {
        $model = $this->getModel($data['type'], $data['id']);

        if (isset($data['parent_id'])) {
            $this->exists($data['parent_id']);
        }

        Comment::create($data + [
            'user_id' => auth()->id(),
            'commentable_type' => get_class($model),
            'commentable_id' => $model->getKey(),
        ]);
    }

    public function update(array $data)
    {
        Comment::query()
            ->where('user_id', auth()->id())
            ->findOrFail($data['id'])
            ->update($data);
    }

    public function destroy($id)
    {
        Comment::query()
            ->where('user_id', auth()->id())
            ->findOrFail($id)
            ->delete();
    }

    public function exists($id, string $errorKey = 'parent_id')
    {
        $comment = Comment::query()->find($id);

        if (! $comment) {
            throw new ValidationErrorsException([
                $errorKey => translate_error_message('comment', 'not_exists'),
            ]);
        }

        return $comment;
    }

    /**
     * @throws CommentException
     * @throws ValidationErrorsException
     */
    private function getModel($type, $id)
    {
        if ($type == CommentTypeEnum::BLOG) {
            return (new PublicBlogService)->exists($id, 'id');
        }

        CommentException::invalidType();
    }
}
