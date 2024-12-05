<?php

namespace Modules\Section\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Section\Http\Requests\SectionRequest;
use Modules\Section\Services\AdminSectionService;
use Modules\Section\Transformers\SectionResource;

class AdminSectionController extends Controller
{
    use HttpResponse;

    public AdminSectionService $adminSectionService;

    public function __construct(AdminSectionService $adminSectionService)
    {
        $this->adminSectionService = $adminSectionService;
    }

    public function index(): JsonResponse
    {
        $sections = $this->adminSectionService->index();

        return $this->paginatedResponse($sections, SectionResource::class);
    }

    public function store(SectionRequest $request): JsonResponse
    {
        $this->adminSectionService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('section', 'created'));
    }

    public function show($id): JsonResponse
    {
        $result = $this->adminSectionService->show($id);

        return $this->resourceResponse(new SectionResource($result));
    }

    public function update(SectionRequest $request, $id): JsonResponse
    {
        $this->adminSectionService->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('section', 'updated'));
    }

    public function destroy($id): JsonResponse
    {
        $this->adminSectionService->destroy($id);

        return $this->okResponse(message: translate_success_message('section', 'deleted'));
    }
}
