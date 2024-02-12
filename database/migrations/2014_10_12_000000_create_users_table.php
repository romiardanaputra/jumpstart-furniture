<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('current_team_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact');
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
