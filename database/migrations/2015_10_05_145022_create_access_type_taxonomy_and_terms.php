<?php

use Illuminate\Database\Migrations\Migration;

class CreateAccessTypeTaxonomyAndTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!class_exists('Taxonomy')) return;
        
        $vocabulary = Taxonomy::createVocabulary('access_type');

        Taxonomy::createTerm($vocabulary->id, 'FTP');
        Taxonomy::createTerm($vocabulary->id, 'SSH');
        Taxonomy::createTerm($vocabulary->id, 'CMS');
        Taxonomy::createTerm($vocabulary->id, 'Database');
        Taxonomy::createTerm($vocabulary->id, 'Other');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!class_exists('Taxonomy')) return;

        Taxonomy::deleteVocabularyByName('access_type');
    }
}
