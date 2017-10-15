<?php

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

/* $factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
}); */

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'imgpath' => $faker->imageUrl(500, 500, 'cats'),
        'description' => $faker->text(200),
        'price' => $faker->numberBetween(100,1000000)
    ];
});
