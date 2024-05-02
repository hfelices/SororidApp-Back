<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Relation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relation>
 */
class RelationFactory extends Factory
{
    protected $model = Relation::class;

    public function definition()
    {


        do {
            $user1 = User::all()->random()->id;
            $user2 = User::where('id', '!=', $user1)->inRandomOrder()->first()->id;
            $existingRelation = Relation::where('user_1', $user1)
                                        ->where('user_2', $user2)
                                        ->first();
            if ($existingRelation == NULL) {
                return [
                    'user_1' => $user1,
                    'user_2' => $user2,
                    'type' => $this->faker->randomElement(['blocked','first', 'second']), 
                    'status' => $this->faker->randomElement(['pending', 'active']),
                ];
            }
        } while (true);
        
            
       
    }
}