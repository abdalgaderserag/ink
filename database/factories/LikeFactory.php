<?php

use Faker\Generator as Faker;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        //
        'user_id' => random_int(1, 5),
    ];
});
