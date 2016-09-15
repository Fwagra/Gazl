<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactProjectTable extends Migration
{
    /**
     * Run the migrations.
     * NB: Pivot table
     * @return void
     */
    public function up()
    {
        Schema::create('contact_project', function (Blueprint $table) {
            $table->integer('contact_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_project');
    }
}
