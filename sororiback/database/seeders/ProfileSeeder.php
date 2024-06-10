<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'name' => 'Admin',
            'id_user' => 1,
            'alert_password' => Hash::make('admin12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
        Profile::create([
            'name' => 'Test',
            'id_user' => 2,
            'alert_password' => Hash::make('test12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
        Profile::create([
            'name' => 'First',
            'id_user' => 3,
            'alert_password' => Hash::make('first12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
        Profile::create([
            'name' => 'second',
            'id_user' => 4,
            'alert_password' => Hash::make('second12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
        Profile::create([
            'name' => 'Extended',
            'id_user' => 5,
            'alert_password' => Hash::make('extended12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
        Profile::create([
            'name' => 'Amigo Héctor',
            'id_user' => 6,
            'alert_password' => Hash::make('amigo12345'),
            'birthdate' => '2004-03-13',
            'town' => 2,
            'gender' => 'male'
        ]);
    }
}
