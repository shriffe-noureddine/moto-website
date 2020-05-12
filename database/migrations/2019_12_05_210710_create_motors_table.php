<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->Increments('id');            
            $table->integer('constructionDate');
            $table->string('brand',50);
            $table->string('model');            
            $table->string('color',20);            
            $table->decimal('price',14);            
            $table->unsignedInteger('user_id');
            $table->text('description');
            $table->string('picture',300);
            $table->string('thumbnail',300);
            //for cascsade on delete and update
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('motors');
    }
}
