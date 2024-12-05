<?php

namespace Modules\Category\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->whenHas('name'),
            //            'status' => $this->whenHas('status'),
            'parent_id' => $this->when(ResourceHelper::shouldReturnForeignKey($this, 'parentCategory', 'parent_id'), $this->parent_id),
            //            'image' => $this->whenNotNull(ResourceHelper::getFirstMediaOriginalUrl($this, 'image')),
            'sub_categories_count' => $this->whenHas('sub_categories_count'),
            'sub_categories' => CategoryResource::collection($this->whenLoaded('subCategories')),
            'parent_category' => CategoryResource::make($this->whenLoaded('parentCategory')),
        ];
    }
}
