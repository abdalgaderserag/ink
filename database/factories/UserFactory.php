<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $ava = '/images/profiles/';
    $avatars = [
        '20190511_235056.jpg',
        '20190511_235121.jpg',
        'ariya.jpg',
        'freakboy3742.jpg',
        'jessfraz.jpg',
        'kris-nova.jpg',
        'photo-1527980965255-d3b416303d12.jpeg',
        'profile.jpeg',
        'yyx990803.jpg'
    ];

    $bg = '/images/backgrounds/';
    $bgs = [
        '4704.jpg',
        '132408_original_5992x3995.jpg',
        'mailchimp.jpg',
        'mapbox.jpg',
        'profile-image.png'
    ];
    return [
        'name' => $name = $faker->name,
        'details' => $faker->text,
        'slug' => str_slug($name),
        'email' => $faker->unique()->safeEmail,
        'avatar' => $ava . $avatars[random_int(0,7)],
        'background' => $bg . $bgs[random_int(0,4)],
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
