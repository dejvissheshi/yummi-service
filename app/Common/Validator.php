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
            'iat' => Carbon::now(),
            'exp' => Carbon::tomorrow()
        );

        return JWT::encode($payload, $key);
    }

    public static function validateJwt(string $token)
    {
        try {
            $key = env('SECRET_KEY');
            $decoded = JWT::decode($token, $key, array('HS256'));
            $decodedArray = (array)$decoded;
            if ($decodedArray['exp'] < Carbon::now()){
                throw new Exception('Token expired!');
            }

        }catch (Exception $e){
            throw new Exception('Token invalid!');
        }
    }
}
