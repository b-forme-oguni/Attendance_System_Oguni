<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'last_name_kana' =>  $faker->firstKanaName,
        'first_name_kana' => $faker->lastKanaName,
        'school_id' => $faker->numberBetween(1, 2),
    ];
});
