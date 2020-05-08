<?php

/** @var Factory $factory */

use App\Model;
use App\Order\Order;
use App\OrderStatus;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    return [
       'products' => json_encode([
       [
           'quantity' => $faker->randomDigitNotNull,
           'product_id' => $faker->randomDigitNotNull,
       ],
       [
           'quantity' => $faker->randomDigitNotNull,
           'product_id' => $faker->randomDigitNotNull,
       ]
       ]),
        'status' => OrderStatus::Ordered,
        'delivery_time' => Carbon::now(),
        'client_id' => 1
    ];
});
