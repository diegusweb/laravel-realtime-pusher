<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween(5, 40),
        'image' => \Faker\Provider\Image::image(storage_path() . '/app/public/products', 600, 350, 'food', false),
    ];
});
