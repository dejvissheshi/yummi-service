<?php


namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'password',
        'city', 'street', 'apartment'
    ];
}
