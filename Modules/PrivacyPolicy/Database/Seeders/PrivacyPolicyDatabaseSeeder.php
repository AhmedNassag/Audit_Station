<?php

namespace Modules\PrivacyPolicy\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PrivacyPolicy\Models\PrivacyPolicy;

class PrivacyPolicyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::create(['content' => fake()->text()]);
    }
}
