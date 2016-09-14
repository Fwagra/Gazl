<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternaldocumentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_documentations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('project_id');
            $table->mediumtext('md_value');
            $table->mediumtext('html_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('internal_documentations');
    }
}
