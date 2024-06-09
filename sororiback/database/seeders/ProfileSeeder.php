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
    }
}
