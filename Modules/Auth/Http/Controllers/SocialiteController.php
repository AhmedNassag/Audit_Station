<?php

namespace Modules\Auth\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\SocialAuthRequest;
use Modules\Auth\Services\SocialiteService;
use Modules\Auth\Transformers\UserResource;

class SocialiteController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly SocialiteService $socialiteService) {}

    public function user(SocialAuthRequest $request)
    {
        $user = $this->socialiteService->handleProviderCallback($request->validated());

        return $this->okResponse(UserResource::make($user), message: translate_word('logged_in'));
    }
}
