<?php

use Illuminate\Database\Seeder;

class ChecklistPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ChecklistPoint::class, 15)->create();
    }
}
