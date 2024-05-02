<?php

namespace Database\Factories;

use App\Models\Town;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class TownFactory extends Factory
{
    protected $model = Town::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'region' => Region::all()->random()->id,
        ];
    }
}