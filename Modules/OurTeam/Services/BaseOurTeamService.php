<?php

namespace Modules\OurTeam\Services;

use Modules\OurTeam\Entities\OurTeam;

class BaseOurTeamService
{
    protected OurTeam $ourTeamModel;

    public function __construct()
    {
        $this->ourTeamModel = new OurTeam;
    }

    protected function baseIndex()
    {
        return $this->ourTeamModel::query()
            ->with(['image', 'section'])
            ->latest()
            ->searchByForeignKey('section_id', request()->input('section_id'))
            ->searchable(['name'])
            ->paginatedCollection();
    }
}
