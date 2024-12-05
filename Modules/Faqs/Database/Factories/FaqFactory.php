<?php

namespace Modules\Faqs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Faqs\Models\Faq::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [

            'question' => 'This project is a comprehensive online',
            'answer' => 'This project is a comprehensive online cinema ticket booking system designed to streamline the process of reserving movie tickets. Users can browse through available movies',
            'category_id' => rand(1, CategoryDatabaseSeeder::$count),
            'important' => random_int(0, 1),

        ];
    }
}
