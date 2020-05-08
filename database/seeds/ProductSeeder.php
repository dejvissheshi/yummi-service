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
                'product_name' => 'Pizza 1',
                'product_type' => 'pizza',
                'price_euro' => 4,
                'price_dollar' => 4.32,
                'description' => Str::random(10),
                'photo' => Str::random(10)
            ],
            [
                'product_name' => 'Pizza 2',
                'product_type' => 'pizza',
                'price_euro' => 4,
                'price_dollar' => 4.32,
                'description' => Str::random(10),
                'photo' => Str::random(10)
            ],
            [
                'product_name' => 'Drink 1',
                'product_type' => 'drink',
                'price_euro' => 2,
                'price_dollar' => 2.16,
                'description' => Str::random(10),
                'photo' => Str::random(10)
            ]
        ]);
    }
}
