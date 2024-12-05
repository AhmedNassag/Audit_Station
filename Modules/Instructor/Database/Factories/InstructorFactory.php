<?php

namespace Modules\Instructor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Instructor\Models\Instructor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
