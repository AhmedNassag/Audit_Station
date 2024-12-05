<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Blog\Models\Blog;

class BlogDatabaseSeeder extends Seeder
{
    public static int $recordsCount = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $this->call([
            BlogAuthorSeeder::class,
        ]);

        for ($i = 0; $i < self::$recordsCount; $i++) {
            Blog::create([
                'title' => fake()->name(),
                'minutes' => rand(1, 120),
                'description' => fake()->sentence(),
                'category_id' => rand(1, 5),
                'blog_author_id' => rand(1, BlogAuthorSeeder::$recordsCount),
                'tags' => [fake()->name(), fake()->name(), fake()->lastName()],
            ]);
        }
    }
}
