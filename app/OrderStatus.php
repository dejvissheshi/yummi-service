<?php


namespace App;


use MyCLabs\Enum\Enum;

class OrderStatus extends Enum
{
    public const Ordered = 'ordered';
    public const Delivered = 'delivered';
}
