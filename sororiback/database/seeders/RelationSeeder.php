<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Relation;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relation::create([
            'user_1' => 2,
            'user_2' => 3,
            'type' => 'first',
            'status' => 'active',
        ]);
        Relation::create([
            'user_1' => 2,
            'user_2' => 4,
            'type' => 'second',
            'status' => 'active',
        ]);
        Relation::create([
            'user_1' => 4,
            'user_2' => 5,
            'type' => 'second',
            'status' => 'active',
        ]);
    }
}
