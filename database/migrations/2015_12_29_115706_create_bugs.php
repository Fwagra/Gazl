<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->string('author');
            $table->string('email');
            $table->boolean('guest');
            $table->boolean('private');
            $table->integer('state')->unsigned();
            $table->string('url');
            $table->text('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bugs');
    }
}
