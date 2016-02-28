<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugsComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('bug_id');
            $table->longText('comment');
            $table->string('name');
            $table->boolean('guest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bugs_comments');
    }
}
