<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => User::factory()->create()->id,
            'name' => $this->faker->name,
            'alert_password' => $this->faker->password,
            'birthdate' => $this->faker->date(),
            'town' => Town::all()->random()->id,
            'gender' => $this->faker->randomElement(['female', 'male', 'nonbinary']),
        ];
    }
}
