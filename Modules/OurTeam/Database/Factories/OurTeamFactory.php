<?php

namespace Modules\OurTeam\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\OurTeam\Entities\OurTeam;
use Modules\Section\Entities\Section;

class OurTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = OurTeam::class;

    public $sections;

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->sections = Section::all()->pluck('id')->toArray();
    }

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'facebook' => fake()->randomElement([null, 'https://facebook.com']),
            'instagram' => fake()->randomElement([null, 'https://instagram.com']),
            'linkedin' => fake()->randomElement([null, 'https://linkedin.com']),
            'whatsApp' => fake()->randomElement([null, 'https://wa.com']),
            'youtube' => fake()->randomElement([null, 'https://youtube.com']),
            'twitter' => fake()->randomElement([null, 'https://twitter.com']),
            'section_id' => fake()->numberBetween(1, $this->sections),
            'created_at' => now(),
        ];
    }
}
