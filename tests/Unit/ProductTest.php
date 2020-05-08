<?php

namespace Tests\Unit;

use App\Product;
use App\ProductPriceType;
use App\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWithTypeAndPriceFiltersNoPriceType()
    {
        $productClass = new Product();
        $retrievedProducts = $productClass->getWithTypeAndPriceFilters();
        $this->assertCount(10, $retrievedProducts);
    }

    public function testGetWithTypeAndPriceFiltersPriceType()
    {
        $productClass = new Product();
        $retrievedProducts = $productClass->getWithTypeAndPriceFilters(null, ProductType::PIZZA);
        $this->assertCount(8, $retrievedProducts);
    }

    public function testGetWithTypeAndPriceFiltersPriceEuro()
    {
        $productClass = new Product();
        $retrievedProducts = $productClass->getWithTypeAndPriceFilters(ProductPriceType::EURO, ProductType::PIZZA);
        $this->assertEquals(4, $retrievedProducts[0]->price_euro);
    }
}
