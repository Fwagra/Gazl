<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowsNullForTermRelationsRelationableId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('term_relations', function (Blueprint $table) {
            $table->integer('relationable_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('term_relations', function (Blueprint $table) {
            $table->integer('relationable_id')->unsigned()->change();
        });
    }
}
