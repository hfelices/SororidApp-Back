<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Town::create([
            'name' => 'San Pere de Ribes',
            'region' => 1
        ]);
        Town::create([
            'name' => 'Cubelles',
            'region' => 1
        ]);
        Town::create([
            'name' => 'Vilanova',
            'region' => 1
        ]);
        Town::create([
            'name' => 'Sitges',
            'region' => 1
        ]);
        Town::create([
            'name' => 'Olivella',
            'region' => 1
        ]);
        Town::create([
            'name' => 'Canyelles',
            'region' => 1
        ]);
    }
}
