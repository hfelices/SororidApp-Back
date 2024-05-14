<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->string('profile_img_path')->nullable();
            $table->string('name')->nullable();
            $table->string('alert_password')->nullable();
            $table->date('birthdate')->nullable();
            $table->foreignId('town')->constrained('towns')->nullable();
            $table->enum('gender', ['female', 'male', 'nonbinary'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
