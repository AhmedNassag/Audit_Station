<?php

namespace Modules\Section\Services;

class PublicSectionService extends BaseSectionService
{
    public function index()
    {
        return $this->baseIndex();
    }
}
