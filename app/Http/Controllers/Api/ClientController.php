<?php


namespace App\Http\Controllers\Api;

use App\Domain\GetAuthenticatedUserQuery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class ClientController extends Controller
{
    public function getClientInfo(Request $request)
    {
        $token = $request->input('token');
        try {
            $client = GetAuthenticatedUserQuery::getUserInfo($token);
            return response([
                'success' => true,
                'data' => [
                    'client' => $client
                ]
            ], 200);
        } catch (Exception $e) {
            return response([
                'success' => false
            ], 404);
        }
    }
}
