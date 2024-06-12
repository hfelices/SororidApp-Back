<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Location;
use App\Models\Town;
use App\Models\Region;
use App\Models\Route;
use App\Models\RoutePartner;
use App\Models\Warning;
use App\Models\Relation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RegionSeeder::class);
        $this->call(TownSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(RelationSeeder::class);
        // $profile = Profile::factory(60)->create();
        // $location = Location::factory(10)->create();
        // $route = Route::factory(10)->create();
        // $routePartner = RoutePartner::factory(10)->create();
        // $warning = Warning::factory(10)->create();
       
        // for ($i=0; $i < 30*30; $i++) { 
        //     $relations = Relation::factory(1)->create();
        // }
        
    }
}
