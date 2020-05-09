<?php

/** @var Factory $factory */

use App\LoginHistory;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(LoginHistory::class, function (Faker $faker) {
    return [
        'client_id' => $faker->randomDigitNotNull,
        'token' => 'kafakdjfshsdkjfhdsakjfhadkslfh',
        'email' => $faker->email,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
