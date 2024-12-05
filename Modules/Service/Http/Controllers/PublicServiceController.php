<?php

namespace Modules\Service\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Service\Services\PublicServiceLogic;
use Modules\Service\Transformers\ServiceResource;

class PublicServiceController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly PublicServiceLogic $publicServiceLogic) {}

    public function index()
    {
        $services = $this->publicServiceLogic->index();

        return $this->paginatedResponse($services, ServiceResource::class);
    }

    public function show($id)
    {
        $service = $this->publicServiceLogic->show($id);

        return $this->resourceResponse(ServiceResource::make($service));
    }
}
