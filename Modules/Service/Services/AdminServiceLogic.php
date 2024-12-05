<?php

namespace Modules\Service\Services;

use App\Exceptions\ValidationErrorsException;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\Service\Models\Service;

class AdminServiceLogic
{
    public function __construct(private readonly Service $serviceModel) {}

    public function index()
    {
        return $this->serviceModel::query()
            ->latest()
            ->with('image')
            ->searchable(['title'])
            ->paginatedCollection();
    }

    /**
     * @throws ValidationErrorsException
     */
    public function store(array $data)
    {
        $this->assertUnique($data['title']);

        DB::transaction(function () use ($data) {
            $service = $this->serviceModel->create($data);

            $imageService = new ImageService($service, $data);
            $imageService->storeOneMediaFromRequest('services_image', 'image');
        });
    }

    public function update(array $data, $id)
    {
        $service = Service::query()->findOrFail($id);

        $this->assertUnique($data['title'] ?? $service->title, $id);

        DB::transaction(function () use ($service, $data) {
            $service->update($data);

            $imageService = new ImageService($service, $data);
            $imageService->updateOneMedia(
                'services_image',
                'image',
            );
        });
    }

    public function show($id)
    {
        return $this->serviceModel->with('image')->findOrFail($id);
    }

    public function destroy($id)
    {
        Service::query()->findOrFail($id)->delete();
    }

    /**
     * @throws ValidationErrorsException
     */
    private function assertUnique(string $title, $id = null): void
    {
        $exists = Service::query()
            ->when(! is_null($id), fn ($q) => $q->where('id', '<>', $id))
            ->where('title', $title)
            ->exists();

        if ($exists) {
            throw new ValidationErrorsException([
                'title' => translate_error_message('service', 'exists'),
            ]);
        }
    }
}
