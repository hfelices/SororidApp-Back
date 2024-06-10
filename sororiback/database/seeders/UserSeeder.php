<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'made_profile' => true,
            'role' => 'admin'
        ]);
        User::create([
            'email' => 'test@test.com',
            'password' => Hash::make('test1234'),
            'made_profile' => true,
            'role' => 'common'
        ]);
        User::create([
            'email' => 'first@first.com',
            'password' => Hash::make('first1234'),
            'made_profile' => true,
            'role' => 'common'
        ]);
        User::create([
            'email' => 'second@second.com',
            'password' => Hash::make('second1234'),
            'made_profile' => true,
            'role' => 'common'
        ]);
        User::create([
            'email' => 'extended@extended.com',
            'password' => Hash::make('extended1234'),
            'made_profile' => true,
            'role' => 'common'
        ]);
        User::create([
            'email' => 'amigo@hector.com',
            'password' => Hash::make('amigo1234'),
            'made_profile' => true,
            'role' => 'common'
        ]);
    }
}
