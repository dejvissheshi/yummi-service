<?php

namespace Tests\Feature;

use App\Client\Client;
use App\Common\Validator;
use App\Domain\GetClientOrdersQuery;
use App\LoginHistory\LoginHistory;
use App\Order\Order;
use App\OrderStatus;
use App\Product\Product;
use App\ProductPriceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetClientOrdersQueryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAuthenticatedClientOrdersPriceDollar()
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

        $defaultClient = factory(Client::class)->create([
            'id' => 1
        ]);
        $loginHistory = factory(LoginHistory::class)->create([
            'client_id'=>$defaultClient->id,
            'email'=>$defaultClient->email,
            'token'=>Validator::generateJwt()
        ]);

        factory(Order::class)->create([
            'products' => json_encode([
                [
                    'quantity' => 1,
                    'product_id' => $product1->id
                ],
                [
                    'quantity' => 1,
                    'product_id' => $product2->id
                ]
            ]),
            'status' => OrderStatus::Ordered
        ]);

       $orders = GetClientOrdersQuery::getAuthenticatedClientOrders($loginHistory->token, ProductPriceType::DOLLAR);

       $this->assertCount(2, $orders);
       $this->assertEquals($product1->id, $orders[0]['id']);
       $this->assertEquals(4.32, $orders[0]['price']);
    }

    public function testGetAuthenticatedClientOneOrder()
    {
        $product1 = factory(Product::class)->create([
            'id'=>1,
            'product_name' => 'Capricciosa',
            'product_type' => 'pizza',
            'price_euro' => 4,
            'price_dollar' => 4.32
        ]);

        $defaultClient = factory(Client::class)->create([
            'id' => 1
        ]);
        $loginHistory = factory(LoginHistory::class)->create([
            'client_id'=>$defaultClient->id,
            'email'=>$defaultClient->email,
            'token'=>Validator::generateJwt()
        ]);

        factory(Order::class)->create([
            'products' => json_encode([
                [
                    'quantity' => 1,
                    'product_id' => $product1->id
                ]
            ]),
            'status' => OrderStatus::Ordered
        ]);

        $orders = GetClientOrdersQuery::getAuthenticatedClientOrders($loginHistory->token);

        $this->assertCount(1, $orders);
        $this->assertEquals($product1->id, $orders[0]['id']);
        $this->assertEquals(4, $orders[0]['price']);
    }

    public function testGetAuthenticatedClientNoOrder()
    {
        $defaultClient = factory(Client::class)->create([
            'id' => 1
        ]);
        $loginHistory = factory(LoginHistory::class)->create([
            'client_id'=>$defaultClient->id,
            'email'=>$defaultClient->email,
            'token'=>Validator::generateJwt()
        ]);

        $orders = GetClientOrdersQuery::getAuthenticatedClientOrders($loginHistory->token);

        $this->assertCount(0, $orders);
    }
}
