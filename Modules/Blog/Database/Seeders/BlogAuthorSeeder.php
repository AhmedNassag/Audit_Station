<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\BlogAuthor;

class BlogAuthorSeeder extends Seeder
{
    public static int $recordsCount = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < self::$recordsCount; $i++) {
            BlogAuthor::create([
                'name' => fake()->name(),
                'description' => fake()->sentence(),
            ]);
        }
    }
}
