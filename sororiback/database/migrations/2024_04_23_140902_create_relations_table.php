<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_1')->constrained('users');
            $table->foreignId('user_2')->constrained('users');
            $table->unique(['user_1', 'user_2']);
            $table->enum('type', ['first', 'second', 'blocked']);
            $table->enum('status', ['pending', 'active']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
