<?php

namespace Modules\Step\Services;

use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\Step\Models\Step;

readonly class StepService
{
    public function __construct(private Step $stepModel) {}

    public function index()
    {
        return Step::query()
            ->latest()
            ->with('image')
            ->searchable(['content'])
            ->get();
    }

    public function show($id)
    {
        return $this->stepModel->with('image')->findOrFail($id);
    }

    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $step = $this->stepModel::create($data);

            $imageService = new ImageService($step, $data);
            $imageService->storeOneMediaFromRequest(
                'steps_to_be_unique_image',
                'image',
            );
        });
    }

    public function update($id, array $data)
    {
        $step = Step::query()->findOrFail($id);

        DB::transaction(function () use ($step, $data) {
            $step->update($data);

            $imageService = new ImageService($step, $data);
            $imageService->updateOneMedia(
                'steps_to_be_unique_image',
                'image',
            );
        });
    }

    public function destroy($id)
    {
        Step::query()->findOrFail($id)->delete();
    }
}
