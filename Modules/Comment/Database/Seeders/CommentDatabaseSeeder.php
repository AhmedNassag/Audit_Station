<?php

namespace Modules\Comment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\Enums\UserTypeEnum;
use Modules\Blog\Database\Seeders\BlogDatabaseSeeder;
use Modules\Blog\Models\Blog;
use Modules\Comment\Models\Comment;

class CommentDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $types = [[
            'model' => Blog::class,
            'max_id' => BlogDatabaseSeeder::$recordsCount,
        ]];

        for ($i = 0; $i < 100; $i++) {
            $randomType = $types[0];

            Comment::create([
                'commentable_type' => $randomType['model'],
                'commentable_id' => rand(1, $randomType['max_id']),
                'content' => fake()->sentence(),
                'user_id' => UserTypeEnum::USER + 1, // real id in db
            ]);
        }
    }
}
