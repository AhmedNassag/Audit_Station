<?php

namespace Modules\Service\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Service\Models\Service;

class ServiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 50; $i++) {
            Service::query()->create([
                'title' => fake()->name(),
                'description' => fake()->sentence(),
                'status' => fake()->boolean(),
            ]);
        }
    }
}
