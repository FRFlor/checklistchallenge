<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ChecklistTemplate;
use App\ItemTemplate;
use Faker\Generator as Faker;

$factory->define(ItemTemplate::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'checklist_id' => function () {
            return factory(ChecklistTemplate::class)->create()->id;
        }
    ];
});
