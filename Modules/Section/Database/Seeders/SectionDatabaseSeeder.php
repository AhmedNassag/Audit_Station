<?php

namespace Modules\Section\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Section\Entities\Section;

class SectionDatabaseSeeder extends Seeder
{
    public static int $recordCount = 100;

    public function run()
    {
        for ($i = 0; $i < self::$recordCount; $i++) {
            Section::create([
                'title' => fake()->name(),
            ]);
        }
    }
}
