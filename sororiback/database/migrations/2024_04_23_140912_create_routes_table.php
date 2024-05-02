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
            $table->decimal('coordinates_start', 8, 6);
            $table->decimal('coordinates_end', 8, 6);
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->foreignId('user')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
