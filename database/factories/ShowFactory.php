<?php

use Faker\Generator as Faker;

$factory->define(App\Show::class, function (Faker $faker) {
    return [
        'owner_id' => $faker->numberBetween(1, 5),
        'user_id' => $faker->numberBetween(1, 5),
    ];
});
