<?php

/** @var Factory $factory */

use App\Product\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->name,
        'product_type' => 'pizza',
        'price_euro' => 0,
        'price_dollar' => 0,
        'description' => $faker->sentence,
        'photo' => $faker->paragraph
    ];
});
