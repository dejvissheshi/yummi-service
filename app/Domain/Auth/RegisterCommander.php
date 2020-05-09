<?php


namespace App\Domain\Auth;

use Exception;
use App\Client\Client;

class RegisterCommander
{
    public static function register($data)
    {
        try {
            $client = new Client();
            $client->name = $data['name'];
            $client->surname = $data['surname'];
            $client->email = $data['email'];
            $client->password = $data['password'];
            if (isset($data['city'])) {
                $client->city = $data['city'];
            }
            if (isset($data['street'])) {
                $client->street = $data['street'];
            }
            if (isset($data['apartment'])) {
                $client->apartment = $data['apartment'];
            }
            $client->save();
            return;
        } catch (Exception $e) {
            throw new Exception("User not created successfully!");
        }
    }
}
