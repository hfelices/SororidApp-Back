<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('route_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route')->constrained('routes');
            $table->foreignId('user')->constrained('users');
            $table->boolean('viewed')->default(false);
            $table->decimal('coordinates_lat_last', 18, 16)->nullable();
            $table->decimal('coordinates_lon_last', 18, 16)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_partners');
    }
}
