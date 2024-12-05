<?php

namespace Modules\Step\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Step\Models\Step;

class StepDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Step::create(['content' => fake()->sentence()]);
        }
    }
}
