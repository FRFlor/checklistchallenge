<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attempt;
use App\Checklist;
use Faker\Generator as Faker;

$factory->define(Attempt::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'checklist_id' => function () {
            return factory(Checklist::class)->create()->id;
        }
    ];
});
