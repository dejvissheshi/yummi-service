<?php


namespace App\Domain;
use App\Order\Order;

class SingleOrderQuery
{
    public static function getSingleOrder(int $orderId)
    {
        return Order::find($orderId);
    }
}
