<?php

namespace Modules\Blog\Services;

use App\Exceptions\ValidationErrorsException;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\BlogAuthor;

class AdminBlogAuthorService
{
    public function index()
    {
        return BlogAuthor::query()
            ->with('image')
            ->latest()
            ->searchable()
            ->paginatedCollection();
    }

    public function show($id)
    {
        return BlogAuthor::query()->with('image')->findOrFail($id);
    }

    public function store(array $data)
    {
        $this->assertUnique($data['name']);

        DB::transaction(function () use ($data) {
            $author = BlogAuthor::create($data);
            $imageService = new ImageService($author, $data);
            $imageService->storeOneMediaFromRequest('blog_author', 'image');
        });
    }

    public function update(array $data, $id)
    {
        $author = BlogAuthor::findOrFail($id);

        $this->assertUnique($data['name'] ?? $author->name, $id);

        DB::transaction(function () use ($data, $author) {
            $author->update($data);
            $imageService = new ImageService($author, $data);
            $imageService->updateOneMedia('blog_author', 'image');
        });
    }

    private function assertUnique(string $name, $id = null)
    {
        $exists = BlogAuthor::query()
            ->where('name', $name)
            ->when(! is_null($id), fn ($q) => $q->where('id', '!=', $id))
            ->exists();

        if ($exists) {
            throw new ValidationErrorsException([
                'name' => translate_error_message('name', 'exists'),
            ]);
        }
    }

    public function exists($id, string $errorKey = 'author_id')
    {
        $author = BlogAuthor::query()->find($id);

        if (! $author) {
            throw new ValidationErrorsException([
                $errorKey => translate_error_message('author', 'not_exists'),
            ]);
        }

        return $author;
    }
}
