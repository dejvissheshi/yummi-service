<?php


namespace App\Domain;

use Exception;

use App\Client\Client;
use App\LoginHistory\LoginHistory;

class GetAuthenticatedUserQuery
{
    public static function getUserInfo(string $token)
    {

        $clientId = LoginHistory::where('token', $token)->select('client_id')->first();
        if (!$clientId)
            throw new Exception('No user id found');

        $client = Client::find($clientId);
        return $client;
    }
}
