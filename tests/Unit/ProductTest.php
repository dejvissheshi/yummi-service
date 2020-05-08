<?php

namespace Tests\Unit;

use App\Product\Product;
use App\ProductPriceType;
use App\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWithTypeAndPriceFiltersNoPriceType()
    {
        factory(Product::class,3)->create();
        $retrievedProducts = Product::getWithTypeAndPriceFilters();
        $this->assertCount(3, $retrievedProducts);
    }

    public function testGetWithTypeAndPriceFiltersProductType()
    {
        factory(Product::class)->create([
                'product_type' => 'pizza'
            ]);
        factory(Product::class)->create([
                'product_type' => 'drinks'
            ]);
        $retrievedProducts = Product::getWithTypeAndPriceFilters(null, ProductType::PIZZA);
        $this->assertCount(1, $retrievedProducts);
    }

    public function testGetWithTypeAndPriceFiltersPriceEuro()
    {
        factory(Product::class)->create([
            'product_type' => 'pizza',
            'price_euro' => 4,
            'price_dollar' => 4.32,
        ]);
        $retrievedProducts = Product::getWithTypeAndPriceFilters(ProductPriceType::EURO, ProductType::PIZZA);
        $this->assertEquals(4, $retrievedProducts[0]->price_euro);
    }
}
