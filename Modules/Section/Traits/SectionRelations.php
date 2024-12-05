<?php

namespace Modules\Section\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\OurTeam\Entities\OurTeam;

trait SectionRelations
{
    public function ourTeams(): HasMany
    {
        return $this->hasMany(OurTeam::class, 'section_id');
    }
}
