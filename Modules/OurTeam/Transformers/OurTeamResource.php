<?php

namespace Modules\OurTeam\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Section\Transformers\SectionResource;

class OurTeamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'facebook' => $this->whenHas('facebook'),
            'instagram' => $this->whenHas('instagram'),
            'twitter' => $this->whenHas('twitter'),
            'telegram' => $this->whenHas('telegram'),
            'whatsapp' => $this->whenHas('whatsapp'),
            'snapchat' => $this->whenHas('snapchat'),
            'tiktok' => $this->whenHas('tiktok'),
            'github' => $this->whenHas('github'),
            'image' => $this->whenNotNull(ResourceHelper::getFirstMediaOriginalUrl($this, 'image')),
            'section' => $this->whenLoaded('section', function () {
                return SectionResource::make($this->section);
            }),
        ];
    }
}
