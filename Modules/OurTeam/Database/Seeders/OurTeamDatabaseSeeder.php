<?php

namespace Modules\OurTeam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\OurTeam\Entities\OurTeam;
use Modules\Section\Database\Seeders\SectionDatabaseSeeder;

class OurTeamDatabaseSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            OurTeam::create([
                'name' => fake()->name(),
                'section_id' => rand(1, SectionDatabaseSeeder::$recordCount),
                'facebook' => fake()->url(),
                'instagram' => fake()->url(),
                'twitter' => fake()->url(),
                'telegram' => fake()->url(),
                'whatsapp' => fake()->url(),
                'snapchat' => fake()->url(),
                'tiktok' => fake()->url(),
                'github' => fake()->url(),
            ]);
        }
    }
}
