<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->randomDigit,
        'title'=>$faker->text(25),
        'postcontent'=>$faker->text(250),
    ];
});
