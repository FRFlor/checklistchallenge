<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attempt;
use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'attempt_id' => function () {
            return factory(Attempt::class)->create()->id;
        }
    ];
});
