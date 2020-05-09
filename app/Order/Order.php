<?php


namespace App\Order;

use App\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'products', 'status', 'delivery_time', 'client_id'
    ];

    protected $attributes = [
      'status' => OrderStatus::Delivered
    ];
}
