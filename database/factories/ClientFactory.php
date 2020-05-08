<?php

/** @var Factory $factory */

use App\Client\Client;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigitNotNull,
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'password' => $faker->password,
        'city' => $faker->city,
        'street' => $faker->streetName,
        'apartment' => $faker->address,
        'created_at' =>Carbon::now(),
        'updated_at' =>Carbon::now()
    ];
});
