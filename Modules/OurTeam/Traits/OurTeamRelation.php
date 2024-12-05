<?php

namespace Modules\OurTeam\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Section\Entities\Section;

trait OurTeamRelation
{
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
