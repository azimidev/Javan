<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_photo', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('post_id')->unsigned();
	        $table->string('name');
	        $table->string('path');
	        $table->string('thumbnail_path');
	        $table->timestamps();
	        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_photo');
    }
}