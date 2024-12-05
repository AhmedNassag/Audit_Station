<?php

namespace Modules\Auth\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Accountant\Database\Factories\AccountantFactory;
use Modules\Auth\Enums\AuthEnum;
use Modules\Auth\Enums\UserTypeEnum;
use Modules\Company\Database\Factories\CompanyFactory;
use Modules\Instructor\Database\Factories\InstructorFactory;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = UserTypeEnum::availableTypes();

        foreach ($userTypes as $type) {
            $alphaType = UserTypeEnum::alphaTypes()[$type];
            $user = User::create([
                'name' => $alphaType,
                'email' => "$alphaType@admin.com",
                'status' => true,
                AuthEnum::VERIFIED_AT => now(),
                'password' => $alphaType,
                'type' => $type,
                'reached_company' => $type == UserTypeEnum::COMPANY,
                'reached_instructor' => $type == UserTypeEnum::INSTRUCTOR,
                'reached_accountant' => in_array($type, [UserTypeEnum::ACCOUNTANT, UserTypeEnum::CERTIFIED, UserTypeEnum::INTERVIEWER]),
                'reached_certified' => in_array($type, [UserTypeEnum::CERTIFIED, UserTypeEnum::INTERVIEWER]),
                'reached_interviewer' => $type == UserTypeEnum::INTERVIEWER,
            ]);

            switch ($type) {
                case UserTypeEnum::ADMIN:
                    $user->assignRole('admin');
                    break;

                case UserTypeEnum::COMPANY:
                    CompanyFactory::new()->create([
                        'user_id' => $user->id,
                    ]);
                    break;

                case UserTypeEnum::INSTRUCTOR:
                    InstructorFactory::new()->create([
                        'user_id' => $user->id,
                    ]);
                    break;

                case UserTypeEnum::ACCOUNTANT:
                case UserTypeEnum::CERTIFIED:
                case UserTypeEnum::INTERVIEWER:
                    AccountantFactory::new()->create([
                        'user_id' => $user->id,
                    ]);
                    break;
                default: break;
            }
        }
    }
}
