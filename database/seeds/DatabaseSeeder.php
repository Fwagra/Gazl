<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AccessTableSeeder::class);
        $this->call(ChecklistPointsTableSeeder::class);
        $this->call(ChecklistCategoriesTableSeeder::class);

        Model::reguard();
    }
}
