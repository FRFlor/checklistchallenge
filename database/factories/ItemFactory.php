<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'checklist_id' => function () {
            return factory(Checklist::class)->create()->id;
        }
    ];
});
