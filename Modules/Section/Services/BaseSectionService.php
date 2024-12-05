<?php

namespace Modules\Section\Services;

use Modules\Section\Entities\Section;

class BaseSectionService
{
    protected Section $sectionModel;

    public function __construct()
    {
        $this->sectionModel = new Section;
    }

    protected function baseIndex()
    {
        return $this->sectionModel::searchable(['title'])->latest()->paginatedcollection();
    }
}
