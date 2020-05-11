<?php

namespace Tests\Feature;

use App\Domain\GetCheckoutInformationQuery;
use App\Product\Product;
use App\ProductPriceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetCheckoutInformationQueryTest extends TestCase
{
    use RefreshDatabase;
    public function testGetCheckoutInformation()
    {
        $product1 = factory(Product::class)->create([
            'id' =>1 ,
            'product_name' => 'Capricciosa',
            'product_type' => 'pizza',
            'price_euro' => 4,
            'price_dollar' => 4.32
        ]);

        $product2 = factory(Product::class)->create([
            'id' => 2,
            'product_name' => 'Water',
            'product_type' => 'drinks',
            'price_euro' => 1.5,
            'price_dollar' => 1.62
        ]);

        $productData = json_encode([
            [
                'id' => $product1->id,
                'quantity' => 1
            ],
            [
                'id' => $product2->id,
                'quantity' => 2
            ]
        ]);
        $data = GetCheckoutInformationQuery::getInformationQuery(null,$productData);

        $this->assertEquals(9, $data['total']);
        $this->assertEquals(7, $data['subtotal']);
        $this->assertEquals(2, $data['transport']);
    }

    public function testGetCheckoutInformationInDollar()
    {
        $product1 = factory(Product::class)->create([
            'id' =>1 ,
            'product_name' => 'Capricciosa',
            'product_type' => 'pizza',
            'price_euro' => 10,
            'price_dollar' => 12
        ]);

        $product2 = factory(Product::class)->create([
            'id' => 2,
            'product_name' => 'Water',
            'product_type' => 'drinks',
            'price_euro' => 5,
            'price_dollar' => 7
        ]);

        $productData = ([
            [
                'id' => $product1->id,
                'quantity' => 1
            ],
            [
                'id' => $product2->id,
                'quantity' => 2
            ]
        ]);
        $data = GetCheckoutInformationQuery::getInformationQuery(ProductPriceType::DOLLAR, $productData);

        $this->assertEquals(28.6, $data['total']);
        $this->assertEquals(26, $data['subtotal']);
        $this->assertEquals(2.6, $data['transport']);
    }
}
