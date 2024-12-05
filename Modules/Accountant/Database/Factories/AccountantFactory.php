<?php

namespace Modules\Accountant\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Accountant\Models\Accountant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
