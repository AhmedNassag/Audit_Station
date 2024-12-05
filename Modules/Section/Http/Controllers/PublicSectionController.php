<?php

namespace Modules\Section\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Section\Services\PublicSectionService;
use Modules\Section\Transformers\SectionResource;

class PublicSectionController extends Controller
{
    use HttpResponse;

    public PublicSectionService $publicSectionService;

    public function __construct(PublicSectionService $publicSectionService)
    {
        $this->publicSectionService = $publicSectionService;
    }

    public function index(): JsonResponse
    {
        return $this->paginatedResponse(
            $this->publicSectionService->index(),
            SectionResource::class
        );
    }
}
