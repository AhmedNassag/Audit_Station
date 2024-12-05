<?php

namespace Modules\Auth\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\RefreshTokenRequest;
use Modules\Auth\Models\RefreshToken;
use Modules\Auth\Services\LoginService;
use Modules\Auth\Services\RefreshTokenService;
use Modules\Auth\Transformers\SanctumTokenResource;

class RefreshTokenController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly RefreshTokenService $refreshTokenService) {}

    public function rotate(RefreshTokenRequest $request)
    {
        $token = $this->refreshTokenService->rotate($request->validated());

        return $this->okResponse(SanctumTokenResource::make($token));
    }

    public function refreshToken(RefreshTokenRequest $request, RefreshTokenService $refreshTokenService): JsonResponse
    {
        $refreshToken = RefreshToken::query()
            ->where('token', $refreshTokenService->getEncryptedToken($request->token))
            ->firstOrFail();

        $refreshTokenService->assertExpired($refreshToken);
        $user = $refreshToken->user;
        LoginService::generateBearerToken($user);

        return $this->resourceResponse(SanctumTokenResource::make($user->token));
    }
}
