<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AboutUs\Helpers\AboutUsPermissionDefinition;
use Modules\Category\Helpers\CategoryPermissionDefinition;
use Modules\ContactUs\Helpers\ContactUsPermissionDefinition;
use Modules\Employee\Helpers\EmployeePermissionHelper;
use Modules\Faqs\Helpers\FaqsPermissionDefinition;
use Modules\OurTeam\Helpers\OurTeamPermissionsHelper;
use Modules\PrivacyPolicy\Helpers\PrivacyPolicyPermissionsHelper;
use Modules\Role\Helpers\PermissionCacheHelper;
use Modules\Role\Helpers\PermissionHelper;
use Modules\Role\Helpers\RolePermissionDefinition;
use Modules\Role\Models\Role;
use Modules\Section\Helpers\SectionPermissionHelper;
use Modules\Service\Helpers\ServicePermissionDefinition;
use Modules\Setting\Helpers\SettingPermissionDefinition;
use Modules\Step\Helpers\StepPermissionDefinition;
use Modules\TermsAndConditions\Helpers\TermsPermissionDefinition;

class RoleDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        $this->createRoles();
    }

    public function createPermissions()
    {
        $allPermissions = [
            ...RolePermissionDefinition::permissions(),
            ...AboutUsPermissionDefinition::permissions(),
            ...CategoryPermissionDefinition::permissions(),
            ...ContactUsPermissionDefinition::permissions(),
            ...TermsPermissionDefinition::permissions(),
            ...PrivacyPolicyPermissionsHelper::permissions(),
            ...SectionPermissionHelper::permissions(),
            ...OurTeamPermissionsHelper::permissions(),
            ...EmployeePermissionHelper::permissions(),
            ...FaqsPermissionDefinition::permissions(),
            ...ServicePermissionDefinition::permissions(),
            ...StepPermissionDefinition::permissions(),
            ...SettingPermissionDefinition::permissions(),
        ];

        $latestPermissions = [];

        foreach ($allPermissions as $parentPermission => $operations) {
            $permission = [];
            foreach ($operations as $operation) {
                $permissionName = PermissionHelper::generatePermissionName($operation, $parentPermission);
                $permission['name'] = $permissionName;

                PermissionHelper::permissionModel()::firstOrCreate(['name' => $permission['name']], $permission);
                $latestPermissions[] = $permission;
            }
        }

        PermissionCacheHelper::setCachedPermissions();

        $permissions = collect($latestPermissions)->pluck('name')->toArray();

        return PermissionHelper::permissionModel()::whereIn('name', $permissions)->get();
    }

    private function createRoles()
    {
        $allPermissions = $this->createPermissions();

        $role = Role::query()->firstOrCreate(['name' => 'admin'], ['name' => 'admin']);

        $role->permissions()->sync($allPermissions->pluck('id')->toArray());
    }
}
