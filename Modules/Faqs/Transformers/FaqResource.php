<?php

namespace Modules\Faqs\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->whenHas('question'),
            'answer' => $this->whenHas('answer'),
            'category_id' => $this->whenHas('category_id'),
            'is_important' => $this->whenHas('is_important'),
            'created_at' => $this->whenHas('created_at'),
        ];
    }
}
