<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
                [
                    'product_name' => 'Capricciosa',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Chicken & Mushroom',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Diavola',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Italian',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Margarita',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Mexican',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Mushroom & Saalam',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Peperoni',
                    'product_type' => 'pizza',
                    'price_euro' => 4,
                    'price_dollar' => 4.32
                ],
                [
                    'product_name' => 'Coca Cola',
                    'product_type' => 'drinks',
                    'price_euro' => 2,
                    'price_dollar' => 2.16
                ],
                [
                    'product_name' => 'Water',
                    'product_type' => 'drinks',
                    'price_euro' => 1.5,
                    'price_dollar' => 1.62
                ]
        ]);
    }
}
