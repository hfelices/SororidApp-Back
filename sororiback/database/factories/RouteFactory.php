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
            'coordinates_lat_start' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_lon_start' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_lat_end' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_lon_end' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_lat_now' => $this->faker->randomFloat(6, -90, 90), 
            'coordinates_lon_now' => $this->faker->randomFloat(6, -90, 90), 
            'distance' => $this->faker->randomFloat(6, -90, 90), 
            'duration' => $this->faker->randomFloat(6, -90, 90), 
            'time_start' => $this->faker->dateTime(),
            'time_estimated' => $this->faker->dateTime(),
            'time_user_end' => $this->faker->dateTime(),
            'time_end' => $this->faker->dateTime(),
            'user' => User::all()->random()->id,
            'share' => $this->faker->randomElement(['first', 'second', 'extended']),
            'status' => $this->faker->randomElement(['active', 'ended', 'alarm']),
        ];
    }
}