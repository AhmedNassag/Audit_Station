<?php

namespace Modules\Service\Services;

use Modules\Service\Models\Service;

class PublicServiceLogic
{
    public function index()
    {
        return Service::query()
            ->latest()
            ->where('status', true)
            ->with('image')
            ->paginatedCollection();
    }

    public function show($id)
    {
        return Service::query()
            ->with('image')
            ->where('status', true)
            ->findOrFail($id);
    }
}
