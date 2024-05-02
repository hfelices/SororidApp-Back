<?php

namespace Database\Factories;

use App\Models\Warning;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warning>
 */
class WarningFactory extends Factory
{
    protected $model = Warning::class;

    public function definition()
    {
        return [
            'route' => Route::all()->random()->id,
            'reason' => $this->faker->randomElement(['still_device', 'incomplete_route', 'alert_password']),
            'details' => $this->faker->sentence(),
        ];
    }
}