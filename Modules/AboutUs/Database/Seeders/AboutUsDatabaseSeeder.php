<?php

namespace Modules\AboutUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AboutUs\Models\AboutUs;

class AboutUsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => fake()->title(),
            'description' => fake()->sentence(),
            'youtube_link' => 'https://www.youtube.com/live/zUfWGqFub5Q?si=YGYBGh9sLuon8YwJ',
            'items' => [
                fake()->sentence(),
                fake()->sentence(),
                fake()->sentence(),
            ],
        ]);
    }
}
