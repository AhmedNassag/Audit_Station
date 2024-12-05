<?php

namespace Modules\OurTeam\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\OurTeam\Services\PublicOurTeamService;
use Modules\OurTeam\Transformers\OurTeamResource;

class PublicOurTeamController extends Controller
{
    use HttpResponse;

    public PublicOurTeamService $publicOurTeamService;

    public function __construct(PublicOurTeamService $publicOurTeamService)
    {
        $this->publicOurTeamService = $publicOurTeamService;
    }

    public function index(): JsonResponse
    {
        return $this->paginatedResponse($this->publicOurTeamService->index(), OurTeamResource::class);
    }
}
