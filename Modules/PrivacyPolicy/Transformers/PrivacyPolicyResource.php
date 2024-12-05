<?php

namespace Modules\PrivacyPolicy\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyPolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'content' => $this->content,
        ];
    }
}
