<?php

namespace Modules\Setting\Database\Seeders;

use Elattar\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;
use Modules\Setting\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'facebook' => fake()->url(),
            'linkedin' => fake()->url(),
            'youtube' => fake()->url(),
            'tiktok' => fake()->url(),
            'snapchat' => fake()->url(),
            'app_store' => fake()->url(),
            'google_play' => fake()->url(),
            'head_quarters' => [fake()->sentence(), fake()->sentence()],
            'our_branches' => [fake()->sentence(), fake()->sentence()],
            'address' => fake()->address(),
            'phones' => [fake()->phoneNumber(), fake()->e164PhoneNumber()],
            'email' => fake()->email(),
            'location' => new Point(30.0444, 31.2357),
        ]);
    }
}
