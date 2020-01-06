<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        Subscriber::A_NAME => $faker->name,
        Subscriber::A_EMAIL => $faker->safeEmail,
    ];
});
