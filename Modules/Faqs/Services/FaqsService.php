<?php

namespace Modules\Faqs\Services;

use App\Exceptions\ValidationErrorsException;
use Modules\Category\Services\CategoryService;
use Modules\Faqs\Models\Faq;

readonly class FaqsService
{
    public function __construct(private Faq $model, private CategoryService $categoryService) {}

    public function index()
    {
        return $this->model::query()
            ->latest()
            ->searchByForeignKey('category_id', request()->input('category_id'))
            ->searchable(['question', 'answer'])
            ->paginatedCollection();
    }

    public function store(array $data)
    {
        $this->categoryService->exists($data['category_id']);

        $this->assertUnique($data['question']);

        $this->model::create($data);
    }

    public function update($id, $data)
    {
        $faq = $this->model->findOrFail($id);

        if (isset($data['category_id'])) {
            $this->categoryService->exists($data['category_id']);
        }

        $this->assertUnique($data['question'] ?? $faq->question, $id);

        $faq->update($data);
    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
    }

    private function assertUnique(string $question, $id = null)
    {
        $exists = $this->model::query()
            ->where('question', $question)
            ->when($id, fn ($q) => $q->where('id', '!=', $id))
            ->exists();

        if ($exists) {
            throw new ValidationErrorsException([
                'question' => translate_error_message('question', 'exists'),
            ]);
        }
    }
}
