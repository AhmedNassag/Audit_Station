<?php

namespace Modules\Faqs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Faqs\Models\Faq;

class FaqsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Faq::query()->create([
                'question' => fake()->sentence(),
                'answer' => fake()->sentence(),
                'category_id' => rand(1, CategoryDatabaseSeeder::$recordsCount),
                'is_important' => fake()->boolean(),
            ]);
        }
    }
}
