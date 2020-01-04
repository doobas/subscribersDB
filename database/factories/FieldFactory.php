<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        Field::A_TITLE => ucfirst($faker->word()),
        Field::A_TYPE => $faker->randomElement(Field::TYPES),
    ];
});
