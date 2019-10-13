<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use App\User;
use Faker\Generator as Faker;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'owner_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
