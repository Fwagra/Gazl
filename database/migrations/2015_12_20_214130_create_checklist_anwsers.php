<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistAnwsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('check')->default(0);
            $table->boolean('active')->default(1);
            $table->integer('checklist_point_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->text('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checklist_answers');
    }
}
