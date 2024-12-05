<?php

namespace Modules\ContactUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ContactUs\Models\ContactUs;

class ContactUsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            ContactUs::create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'subject' => fake()->sentence(),
                'message' => fake()->paragraph(),
            ]);
        }
    }
}
