<?php


namespace App\Domain\Auth;

use App\Client\Client;
use App\Common\Validator;
use App\LoginHistory\LoginHistory;
use Exception;

class LoginCommander
{
    public static function login ($data){

        $client = Client::where([
            ['email', $data['email']],
            ['password', $data['password']]
        ])->first();

        if (!$client)
            throw new Exception('Client not found!');

        $token = Validator::generateJwt();

        self::createLoginHistory($client->id, $token, $client->email);
        return $token;

    }

    protected static function createLoginHistory(string $clientId, $token, $email){
            $loginHistory = new LoginHistory();
            $loginHistory->client_id = $clientId;
            $loginHistory->token = $token;
            $loginHistory->email = $email;
            $loginHistory->save();
    }
}
