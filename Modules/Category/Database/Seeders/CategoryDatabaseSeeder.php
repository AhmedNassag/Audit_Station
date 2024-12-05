<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;

class CategoryDatabaseSeeder extends Seeder
{
    public static int $recordsCount = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $category = Category::create([
                'name' => fake()->name(),
            ]);

            for ($j = 0; $j < 20; $j++) {
                Category::query()->create(['name' => fake()->firstName, 'parent_id' => $category->id]);
            }
        }
    }
}
