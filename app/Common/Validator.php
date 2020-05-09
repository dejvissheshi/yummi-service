<?php

namespace App\Common;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Exception;
use iValidator;

class Validator implements iValidator
{

    public static function generateJwt()
    {
        $key = env('SECRET_KEY');
        $payload = array(
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (7 * 24 * 60 * 60)
        );

        return JWT::encode($payload, $key);
    }

    public static function validateJwt(string $token)
    {
        try {
            $key = env('SECRET_KEY');
            $decoded = JWT::decode($token, $key, array('HS256'));
            $decodedArray = (array)$decoded;
            if ($decodedArray['exp'] < time()){
                throw new Exception('Token expired!');
            }
        }catch (Exception $e){
            throw new Exception('Token invalid!');
        }
    }
}
