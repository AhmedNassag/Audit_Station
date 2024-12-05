<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Database\Factories\CourseSectionFactory;

class CourseSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): CourseSectionFactory
    {
        //return CourseSectionFactory::new();
    }
}
