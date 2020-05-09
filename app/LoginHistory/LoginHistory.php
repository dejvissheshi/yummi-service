<?php

namespace App\LoginHistory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'token', 'email'
    ];

    protected $dates = ['deleted_at'];

}
