<?php

use Illuminate\Database\Seeder;

class ChecklistCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('checklist_categories')->insert([
            'name' => 'Contenu et SEO',
        ]);
         DB::table('checklist_categories')->insert([
            'name' => 'Tests fonctionnels',
        ]); 
         DB::table('checklist_categories')->insert([
            'name' => 'Validation',
        ]);
    }
}
