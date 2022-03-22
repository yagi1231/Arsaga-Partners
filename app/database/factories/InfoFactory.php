<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Info;
use Faker\Generator as Faker;

$factory->define(Info::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'telnum' => $faker->phoneNumber(11),
        'remarks' => $faker->text
    ];
});
