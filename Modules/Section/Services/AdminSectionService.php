<?php

namespace Modules\Section\Services;

use App\Exceptions\ValidationErrorsException;
use Modules\Section\Entities\Section;

class AdminSectionService extends BaseSectionService
{
    public function index()
    {
        return $this->baseIndex();
    }

    public function show($id)
    {
        return $this->sectionModel::query()->where('id', $id)->firstOrFail();
    }

    public function store(array $data)
    {
        $this->assertUnique($data['title']);

        Section::create($data);
    }

    public function update(array $data, $id)
    {
        $section = Section::query()->findOrFail($id);

        $this->assertUnique($data['title'] ?? $section->title);

        $section->update($data);
    }

    /**
     * @throws ValidationErrorsException
     */
    private function assertUnique(string $title, $id = null)
    {
        $exists = Section::query()
            ->where('title', $title)
            ->when(! is_null($id), fn ($q) => $q->where('id', '<>', $id))
            ->exists();

        if ($exists) {
            throw new ValidationErrorsException([
                'title' => translate_error_message('section', 'exists'),
            ]);
        }
    }

    public function destroy($id)
    {
        $section = $this->show($id);

        $section->delete();
    }

    public function exists($id, string $errorKey = 'section_id')
    {
        $section = Section::query()->find($id);

        if (! $section) {
            throw new ValidationErrorsException([
                $errorKey => translate_error_message('section', 'not_exists'),
            ]);
        }

        return $section;
    }
}
