<?php


namespace App\Domain\Auth;

use App\LoginHistory\LoginHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Client\Client;
use App\Common\Validator;

class RegisterCommander
{
    public static function register($data){

        DB::transaction(function() use ($data){
            try {
                $client = new Client();
                $client->name = $data->name;
                $client->surname = $data->surname;
                $client->email = $data->email;
                $client->password = $data->password;
                if (isset($data->city)) {
                    $client->city = $data->city;
                }
                if (isset($data->street)) {
                    $client->street = $data->street;
                }
                if (isset($data->apartment)) {
                    $client->apartment = $data->apartment;
                }
                $client->save();
            }catch (Exception $e){
                throw new Exception("User not created successfully!");
            }

            $token = Validator::generateJwt();
            try {
                self::createLoginHistory($client->id, $token, $client->email);
            }catch (Exception $e){
                logger('error '.$e->getMessage());
                throw new Exception("Login history not created successfully!");
            }
        });

        return;
    }

    public static function createLoginHistory(int $clientId, string $token, string $email){
        $loginHistory = new LoginHistory();
        $loginHistory->client_id = $clientId;
        $loginHistory->token = $token;
        $loginHistory->email = $email;
        $loginHistory->created_at = Carbon::now();
        $loginHistory->updated_at = Carbon::now();
        $loginHistory->save();
    }
}
