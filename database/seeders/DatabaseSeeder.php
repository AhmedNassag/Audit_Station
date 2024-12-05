<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AboutUs\Database\Seeders\AboutUsDatabaseSeeder;
use Modules\Auth\Database\Seeders\AuthDatabaseSeeder;
use Modules\Blog\Database\Seeders\BlogDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Comment\Database\Seeders\CommentDatabaseSeeder;
use Modules\ContactUs\Database\Seeders\ContactUsDatabaseSeeder;
use Modules\Faqs\Database\Seeders\FaqsDatabaseSeeder;
use Modules\OurTeam\Database\Seeders\OurTeamDatabaseSeeder;
use Modules\PrivacyPolicy\Database\Seeders\PrivacyPolicyDatabaseSeeder;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Section\Database\Seeders\SectionDatabaseSeeder;
use Modules\Service\Database\Seeders\ServiceDatabaseSeeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Modules\Step\Database\Seeders\StepDatabaseSeeder;
use Modules\TermsAndConditions\Database\Seeders\TermsAndConditionsDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingDatabaseSeeder::class,
            AboutUsDatabaseSeeder::class,
            TermsAndConditionsDatabaseSeeder::class,
            PrivacyPolicyDatabaseSeeder::class,
            RoleDatabaseSeeder::class,
            AuthDatabaseSeeder::class,
            CategoryDatabaseSeeder::class,
            BlogDatabaseSeeder::class,
            ContactUsDatabaseSeeder::class,
            SectionDatabaseSeeder::class,
            OurTeamDatabaseSeeder::class,
            CommentDatabaseSeeder::class,
            FaqsDatabaseSeeder::class,
            ServiceDatabaseSeeder::class,
            StepDatabaseSeeder::class,
        ]);
    }
}
