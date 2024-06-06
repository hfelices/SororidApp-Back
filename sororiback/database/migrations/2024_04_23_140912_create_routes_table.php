<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->decimal('coordinates_lat_start', 8, 6);
            $table->decimal('coordinates_lon_start', 8, 6);
            $table->decimal('coordinates_lat_end', 8, 6);
            $table->decimal('coordinates_lon_end', 8, 6);
            $table->decimal('coordinates_lat_now', 8, 6);
            $table->decimal('coordinates_lon_now', 8, 6);
            $table->dateTime('time_start');
            $table->dateTime('time_estimated');
            $table->dateTime('time_user_end');
            $table->dateTime('time_end')->nullable();
            $table->foreignId('user')->constrained('users');
            $table->enum('share', ['first', 'second', 'extended']);
            $table->enum('status', ['active', 'ended', 'alarm']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
