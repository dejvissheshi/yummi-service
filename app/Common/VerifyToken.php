<?php


namespace App\Common;

use App\LoginHistory\LoginHistory;
use Exception;

class VerifyToken
{
    public static function isTokenValid($token)
    {
        try {
            LoginHistory::where('token', $token)->first();
        }catch (Exception $e){
            throw new Exception("Token not found");
        }
    }
}
