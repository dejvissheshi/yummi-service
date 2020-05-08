<?php


namespace App\Domain;

use App\Order\Order;

class OrderCommander
{
    public static function createOrder($data){
        $order = new Order();
        $order->product_ids = $data->product_ids;
        $order->delivery_time = $data->delivery_time;
        $order->client_id = $data->client_id;
        $order->status = $data->status;
        $order->save();

        return;
    }
}
