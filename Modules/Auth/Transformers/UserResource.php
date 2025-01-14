<?php

namespace Modules\Auth\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Enums\AuthEnum;
use Modules\Role\Transformers\RoleResource;

class UserResource extends JsonResource
{
    /**
     * @throws \Exception
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->whenHas('name'),
            'reaction' => $this->when(! is_null($this->pivot), function () {
                return $this->pivot->value;
            }),
            AuthEnum::UNIQUE_COLUMN => $this->whenHas(AuthEnum::UNIQUE_COLUMN),
            'phone' => $this->whenHas('phone'),
            'avatar' => $this->whenNotNull($this->getAvatar($request->url())),
            'type' => $this->whenHas('type'),
            'reached_company' => $this->whenHas('reached_company'),
            'reached_instructor' => $this->whenHas('reached_instructor'),
            'reached_accountant' => $this->whenHas('reached_accountant'),
            'reached_certified' => $this->whenHas('reached_certified'),
            'reached_interviewer' => $this->whenHas('reached_interviewer'),
            'last_login_time' => $this->whenHas('last_login_at'),
            $this->mergeWhen(! is_null($this->token), function () {
                return SanctumTokenResource::make($this->token);
            }),
            $this->mergeWhen(! is_null($this->refresh_token), function () {
                $data = collect(SanctumTokenResource::make($this->refresh_token))->toArray();

                return [
                    'refresh_token' => $data['token'],
                    'refresh_token_expires_at' => $data['token_expires_at'],
                ];
            }),
            'status' => $this->whenHas('status'),
            'online' => $this->whenHas('chat_active'),
            'last_time_seen' => $this->whenHas('last_time_seen', function () {
                return ! is_null($this->chat_active) && $this->chat_active ? $this->last_time_seen : null;
            }),
            'social_provider' => $this->whenHas('social_provider'),
            'role' => $this->whenLoaded('roles', function () {
                return RoleResource::make($this->roles->first());
            }),
            $this->mergeWhen($this->relationLoaded('permissionsOnly'), function () {
                $role = $this->permissionsOnly->first();
                $permissions = [];

                if ($role?->relationLoaded('permissions')) {
                    foreach ($role->permissions as $permission) {
                        $permissions[] = $permission->name;
                    }
                }

                return [
                    'permissions' => $this->when((bool) $permissions, $permissions),
                ];
            }),
        ];
    }

    /**
     * @throws \Exception
     */
    private function getAvatar($url)
    {
        return ResourceHelper::getFirstMediaOriginalUrl(
            $this,
            AuthEnum::AVATAR_RELATIONSHIP_NAME,
            'user.png'
        );
    }
}
