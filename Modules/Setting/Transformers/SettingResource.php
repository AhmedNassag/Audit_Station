<?php

namespace Modules\Setting\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Map\Helpers\PointHelper;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            $this->mergeWhen(! is_null($this->location), function () {
                return PointHelper::getFormattedLatLng($this->location);
            }),
            'facebook' => $this->whenHas('facebook'),
            'linkedin' => $this->whenHas('linkedin'),
            'youtube' => $this->whenHas('youtube'),
            'tiktok' => $this->whenHas('tiktok'),
            'snapchat' => $this->whenHas('snapchat'),
            'app_store' => $this->whenHas('app_store'),
            'google_play' => $this->whenHas('google_play'),
            'address' => $this->whenHas('address'),
            'email' => $this->whenHas('email'),
            'head_quarters' => $this->whenHas('head_quarters'),
            'our_branches' => $this->whenHas('our_branches'),
            'phones' => $this->whenHas('phones'),
        ];
    }
}
