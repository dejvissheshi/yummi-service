<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use SoftDeletes;

    public $clientId;
    public $token;
    public $email;
    public $created_at;
    public $updated_at;

    public static function withData($clientId, $token, $email)
    {
        $instance = new self();
        $instance->clientId = $clientId;
        $instance->token = $token;
        $instance->email = $email;
        $instance->created_at = Carbon::now();
        $instance->updated_at = Carbon::now();

        return $instance;
    }

    protected $fillable = [
        'client_id', 'token', 'email', 'created_at', 'updated_at'
    ];

}
