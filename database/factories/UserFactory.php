<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {

    $last_name = $faker->lastKanaName;
    $first_name = $faker->firstKanaName;

    return [
        'last_name' => $last_name,
        'first_name' => $first_name,
        'last_name_kana' => $last_name,
        'first_name_kana' => $first_name,
        'school_id' => $faker->numberBetween(1, 2),
    ];
});
