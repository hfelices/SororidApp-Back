<?php

namespace Database\Factories;

use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    protected $model = Route::class;

    public function definition()
    {
        return [
            'coordinates_start' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_end' => $this->faker->randomFloat(6, -90, 90), 
            'time_start' => $this->faker->dateTime(),
            'time_end' => $this->faker->dateTime(),
            'user' => User::all()->random()->id,
            'share' => $this->faker->randomElement(['first', 'second', 'extended']),
            'status' => $this->faker->randomElement(['active', 'ended', 'alarm']),
        ];
    }
}