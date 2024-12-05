<?php

namespace Modules\OurTeam\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\OurTeam\Http\Requests\OurTeamRequest;
use Modules\OurTeam\Services\AdminOurTeamService;
use Modules\OurTeam\Transformers\OurTeamResource;

class AdminOurTeamController extends Controller
{
    use HttpResponse;

    public AdminOurTeamService $adminOurTeamService;

    public static string $collectionName = 'our_team_photo';

    public function __construct(AdminOurTeamService $adminOurTeamService)
    {
        $this->adminOurTeamService = $adminOurTeamService;
    }

    public function index(): JsonResponse
    {
        $result = $this->adminOurTeamService->index();

        return $this->paginatedResponse($result, OurTeamResource::class);
    }

    public function store(OurTeamRequest $request): JsonResponse
    {
        $this->adminOurTeamService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('team_member', 'created'));
    }

    public function show($id): JsonResponse
    {
        $result = $this->adminOurTeamService->show($id);

        return $this->okResponse(new OurTeamResource($result), translate_word('success'));
    }

    public function update(OurTeamRequest $request, $id): JsonResponse
    {
        $this->adminOurTeamService->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('team_member', 'updated'));
    }

    public function destroy($id): JsonResponse
    {
        $this->adminOurTeamService->destroy($id);

        return $this->okResponse(message: translate_success_message('team_member', 'deleted'));
    }
}
