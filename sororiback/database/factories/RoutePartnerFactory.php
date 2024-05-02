<?php

namespace Database\Factories;

use App\Models\RoutePartner;
use App\Models\User;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoutePartner>
 */
class RoutePartnerFactory extends Factory
{
    protected $model = RoutePartner::class;

    public function definition()
    {
        return [
            'route' =>Route::all()->random()->id,
            'user' => User::all()->random()->id,
        ];
    }
}