<?php

namespace Modules\ContactUs\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->whenHas('name'),
            'email' => $this->whenHas('email'),
            'subject' => $this->whenHas('subject'),
            'created_at' => $this->whenHas('created_at'),
            'message' => $this->whenHas('message'),
        ];
    }
}
