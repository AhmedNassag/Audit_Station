<?php

namespace Modules\Faqs\Models;

use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Category\Models\Category;

class Faq extends Model
{
    use PaginationTrait, Searchable;

    protected $fillable = [
        'question',
        'answer',
        'category_id',
        'is_important',
    ];

    protected $casts = [
        'is_important' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
