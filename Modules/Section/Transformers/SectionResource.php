<?php

namespace Modules\Section\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\OurTeam\Transformers\OurTeamResource;

class SectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->whenHas('id'),
            'title' => $this->whenHas('title'),
            'our_teams' => OurTeamResource::collection($this->whenLoaded('ourTeams')),
        ];
    }
}
