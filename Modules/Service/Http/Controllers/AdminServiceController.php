<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Modules\Service\Http\Requests\ServiceRequest;
use Modules\Service\Services\AdminServiceLogic;
use Modules\Service\Transformers\ServiceResource;

class AdminServiceController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly AdminServiceLogic $serviceLogic) {}

    public function index()
    {
        $services = $this->serviceLogic->index();

        return $this->paginatedResponse($services, ServiceResource::class);
    }

    public function store(ServiceRequest $request)
    {
        $this->serviceLogic->store($request->validated());

        return $this->createdResponse(message: translate_success_message('service', 'created_female'));
    }

    public function show($id)
    {
        $service = $this->serviceLogic->show($id);

        return $this->resourceResponse(ServiceResource::make($service));
    }

    public function update($id, ServiceRequest $request)
    {
        $this->serviceLogic->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('service', 'updated_female'));
    }

    public function destroy($id)
    {
        $this->serviceLogic->destroy($id);

        return $this->okResponse(message: translate_success_message('service', 'deleted_female'));
    }
}
