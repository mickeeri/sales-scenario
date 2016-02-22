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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Expert::class, function (Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'info' => $faker->sentence,
        'website' => $faker->url
    ];
});

//$factory->define(App\Podcast::class, function (Faker\Generator $faker) {
//
//
//    //$experts = \App\Expert::all();
//
//        return [
//            'expert_id' => random_int(\DB::table('experts')->min('id'), \DB::table('experts')->max('id')),
//            'title' => $faker->word,
//            'filename' => 'Values_Are_Never_Grey.m4a'
//        ];
//});

$factory->define(Serverfireteam\Panel\Admin::class, function (Faker\Generator $faker) {
    return [
        'email' => 'admin@test.com',
        'password' => '12345',
        'activated' => 0,
    ];
});

