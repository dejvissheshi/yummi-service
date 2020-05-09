<?php

namespace App\Http\Middleware;

use App\Common\Validator;
use App\Common\VerifyToken;
use Closure;
use Illuminate\Http\Request;
use Exception;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public static function handle($request, Closure $next)
    {
        if (!$request->header('Authenticator')){
            return response(
                [
                    'success' => false,
                    'message' => 'Missing token!'
                ],400);
        }

        $token = $request->header('Authenticator');
        try {

            Validator::validateJwt($token);
            VerifyToken::isTokenValid($token);

            return $next($request);
        }catch (Exception $e){
            return response(
                [
                    'success' => false,
                    'message' => 'Invalid token'
                ],401);
        }


    }

}
