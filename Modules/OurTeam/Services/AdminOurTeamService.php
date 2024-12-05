<?php

namespace Modules\OurTeam\Services;

use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\OurTeam\Entities\OurTeam;
use Modules\OurTeam\Http\Controllers\AdminOurTeamController;
use Modules\Section\Services\AdminSectionService;

class AdminOurTeamService extends BaseOurTeamService
{
    public function index()
    {
        return $this->baseIndex();
    }

    public function store(array $data)
    {
        (new AdminSectionService)->exists($data['section_id']);

        DB::transaction(function () use ($data) {
            $member = OurTeam::create($data);
            $imageService = new ImageService($member, $data);
            $imageService->storeOneMediaFromRequest(AdminOurTeamController::$collectionName, 'image');
        });
    }

    public function update(array $data, $id)
    {
        $member = OurTeam::query()->findOrFail($id);

        if (isset($data['section_id'])) {
            (new AdminSectionService)->exists($data['section_id']);
        }

        DB::transaction(function () use ($data, $member) {
            $member->update($data);
            $imageService = new ImageService($member, $data);
            $imageService->updateOneMedia(AdminOurTeamController::$collectionName, 'image');
        });
    }

    public function show($id)
    {
        return $this->ourTeamModel::query()->with(['image', 'section'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $teamMember = $this->ourTeamModel::query()->findOrFail($id);

        $teamMember->delete();
    }
}
