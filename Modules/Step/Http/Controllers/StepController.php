<?php

namespace Modules\Step\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Modules\Step\Http\Requests\StepRequest;
use Modules\Step\Services\StepService;
use Modules\Step\Transformers\StepResource;

class StepController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly StepService $stepService) {}

    public function index()
    {
        $steps = $this->stepService->index();

        return $this->resourceResponse(StepResource::collection($steps));
    }

    public function store(StepRequest $request)
    {
        $this->stepService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('step', 'created_female'));
    }

    public function show($id)
    {
        $step = $this->stepService->show($id);

        return $this->resourceResponse(StepResource::make($step));
    }

    public function update($id, StepRequest $request)
    {
        $this->stepService->update($id, $request->validated());

        return $this->okResponse(message: translate_success_message('step', 'updated_female'));
    }

    public function destroy($id)
    {
        $this->stepService->destroy($id);

        return $this->okResponse(message: translate_success_message('step', 'deleted_female'));
    }
}
