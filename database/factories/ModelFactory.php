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

// Accesses factory
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

// Checklist Points factory
$factory->define(App\ChecklistPoint::class, function ($faker) {
    $categories =  App\ChecklistCategory::all()->lists('id')->toArray();
    $names = ['Google Analytics', 'Sitemap XML', 'Url Rewriting', 'Duplicate content', 'Robots.txt', 'Lorem lipsum'];
    return [
        'name' => $faker->randomElement($names),
        'description' => implode(' ',$faker->sentences(2)),
        'checklist_category_id' => $faker->randomElement($categories),
        'order' => $faker->randomDigit,
    ];
});
