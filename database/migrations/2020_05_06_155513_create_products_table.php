<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use \App\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $seedData =  [
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
        ];

    public function up()
    {
        DB::transaction(function (){
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('product_name');
                $table->string('product_type');
                $table->float('price_euro');
                $table->float('price_dollar');
                $table->string('description')->nullable();
                $table->string('photo')->nullable();
            });

            DB::table('products')->insert($this->seedData);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
