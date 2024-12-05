<?php

namespace Modules\OurTeam\Services;

class PublicOurTeamService extends BaseOurTeamService
{
    public function index()
    {
        return $this->baseIndex();
    }
}
