<?php

namespace Modules\Section\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Section\Entities\Section;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
        ];
    }
}
