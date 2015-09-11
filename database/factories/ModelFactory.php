<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Access::class, function ($faker) {
    $projects =  App\Project::all()->lists('id')->toArray();
    return [
        'name' => $faker->name,
        'host' => $faker->freeEmailDomain,
        'login' => $faker->name,
        'password' => str_random(10),
        'project_id' => $faker->randomElement($projects),
    ];
});
