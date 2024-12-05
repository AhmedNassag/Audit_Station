<?php

namespace Modules\Company\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Company\Models\Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
