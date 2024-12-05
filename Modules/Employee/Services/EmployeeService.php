<?php

namespace Modules\Employee\Services;

use App\Exceptions\ValidationErrorsException;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Enums\AuthEnum;
use Modules\Auth\Enums\UserTypeEnum;
use Modules\Auth\Services\UserService;
use Modules\Role\Services\PermissionService;
use Modules\Role\Services\RoleService;

readonly class EmployeeService
{
    public function __construct(private User $userModel, PermissionService $permissionService) {}

    public function index()
    {
        return $this->userModel::query()
            ->where('type', UserTypeEnum::ADMIN_EMPLOYEE)
            ->whereHas('roles', fn ($q) => $q->where('status', true))
            ->with(['avatar', 'roles:id,name'])
            ->latest()
            ->searchable(['name', 'email'])
            ->select([
                'id',
                'name',
                'email',
                'phone',
                'status',
            ])
            ->paginatedCollection();
    }

    public function show($id)
    {
        return $this->userModel::query()
            ->where('type', UserTypeEnum::ADMIN_EMPLOYEE)
            ->whereHas('roles', fn ($q) => $q->where('status', true))
            ->with(['avatar', 'roles:id,name'])
            ->select([
                'id',
                'name',
                'email',
                'phone',
            ])
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        UserService::columnExists($data['email'], columnName: 'email', errorKey: 'email');

        RoleService::exists($data['role_id']);

        DB::transaction(function () use ($data) {
            $user = $this->userModel::create($data + [
                'type' => UserTypeEnum::ADMIN_EMPLOYEE,
                'status' => true,
                AuthEnum::VERIFIED_AT => now(),
            ]);
            $user->roles()->attach($data['role_id']);
            $imageService = new ImageService($user, $data);
            $imageService->storeOneMediaFromRequest('avatar', 'avatar');
        });
    }

    /**
     * @throws \Throwable
     * @throws ValidationErrorsException
     */
    public function update(array $data, $id)
    {
        $user = $this->userModel::query()
            ->where('type', UserTypeEnum::ADMIN_EMPLOYEE)
            ->findOrFail($id);

        if (isset($data['role_id'])) {
            RoleService::exists($data['role_id']);
        }

        if (isset($data['email'])) {
            UserService::columnExists($data['email'], $id, 'email', 'email');
        }

        DB::transaction(function () use ($data, $user) {
            $user->update($data);

            $imageService = new ImageService($user, $data);
            $imageService->updateOneMedia('avatar', 'avatar', 'resetAvatar');

            if (isset($data['role_id'])) {
                $user->roles()->sync($data['role_id']);
            }
        });
    }
}
