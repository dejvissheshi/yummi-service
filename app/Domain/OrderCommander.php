<?php


namespace App\Domain;

use App\Order\Order;
use Exception;

class OrderCommander
{
    public static function createOrder($data){
        try {
            $order = new Order();
            $order['products'] = json_encode($data['products']);
            $order->delivery_time = $data['delivery_time'];
            $order->status = $data['status'];
            if(isset($data->client_id)){
                $order->client_id = $data['client_id'];
            }
            $order->save();
            return;
        }catch (Exception $e){
            throw new Exception("Order not saved!");
        }
    }
}
