<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Reservation::class, function (Faker $faker){
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'requirements' => $faker->realText,
        'start_datetime' => $faker->dateTimeThisMonth,
        'end_datetime' => $faker->dateTimeThisMonth
    ];
});
