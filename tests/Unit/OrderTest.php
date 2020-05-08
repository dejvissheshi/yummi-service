<?php

namespace Tests\Unit;

use App\Client\Client;
use App\Domain\SingleOrderQuery;
use App\Domain\OrderCommander;
use App\Order\Order;
use App\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testCreateOrderStatusOrdered()
    {
        $defaultClient = factory(Client::class)->create();
        $orderObject = factory(Order::class)->make([
            'client_id' => $defaultClient->id
        ]);

        OrderCommander::createOrder($orderObject);

        $this->assertDatabaseHas('orders', [
            'client_id' => $defaultClient->id,
            'status' => OrderStatus::Ordered
        ]);
    }

    public function testGetSingleOrder()
    {
        $defaultClient = factory(Client::class)->create();
        $orderObject = factory(Order::class)->create([
            'client_id' => $defaultClient->id
        ]);
        $order = SingleOrderQuery::getSingleOrder($orderObject->id);

        $this->assertEquals($orderObject->name, $order->name);
    }
}
