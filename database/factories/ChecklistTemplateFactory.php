<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ChecklistTemplate;
use App\User;
use Faker\Generator as Faker;

$factory->define(ChecklistTemplate::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'owner_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
