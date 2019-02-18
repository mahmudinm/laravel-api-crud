<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
      'nama' => $faker->name,
      'jenis_kelamin' => $faker->randomElement(['male', 'female']),
    ];
});
