<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Increments('id');
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 200);
            $table->string('phone', 30)->nullable();
            $table->string('location', 50)->nullable();
            $table->string('picture', 100)->nullable();
            $table->enum('level', ['user', 'administrator'])->default('user');
            $table->rememberToken();
            $table->date('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
