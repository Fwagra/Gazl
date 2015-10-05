<?php

use Illuminate\Database\Migrations\Migration;

class CreateCmsTaxonomyAndTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!class_exists('Taxonomy')) return;

        $vocabulary = Taxonomy::createVocabulary('cms');

        Taxonomy::createTerm($vocabulary->id, 'Contao');
        Taxonomy::createTerm($vocabulary->id, 'Drupal');
        Taxonomy::createTerm($vocabulary->id, 'Magento');
        Taxonomy::createTerm($vocabulary->id, 'Prestashop');
        Taxonomy::createTerm($vocabulary->id, 'Wordpress');
        Taxonomy::createTerm($vocabulary->id, 'Symfony');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!class_exists('Taxonomy')) return;

        Taxonomy::deleteVocabularyByName('cms');
    }
}
