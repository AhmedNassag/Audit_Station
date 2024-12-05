<?php

namespace Modules\PrivacyPolicy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Modules\PrivacyPolicy\Http\Requests\PrivacyPolicyRequest;
use Modules\PrivacyPolicy\Models\PrivacyPolicy;
use Modules\PrivacyPolicy\Transformers\PrivacyPolicyResource;

class PrivacyPolicyController extends Controller
{
    use HttpResponse;

    public function show(): JsonResponse
    {
        return $this->resourceResponse(
            PrivacyPolicyResource::make(
                PrivacyPolicy::first(['content']),
                true,
            )
        );
    }

    public function publicShow(): JsonResponse
    {
        return $this->resourceResponse(
            PrivacyPolicyResource::make(
                PrivacyPolicy::first(['content']),
            )
        );
    }

    public function update(PrivacyPolicyRequest $request): JsonResponse
    {
        $privacyPolice = PrivacyPolicy::first();
        $privacyPolice->update($request->validated());

        return $this->createdResponse(
            message: translate_success_message('policy', 'updated')
        );
    }
}
