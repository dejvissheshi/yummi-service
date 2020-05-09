<?php

namespace App\Http\Controllers\Api;

use App\Domain\Auth\LoginCommander;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Auth\RegisterCommander;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|max:50',
        ]);

        try {
            RegisterCommander::register($validatedData);
            return response([
                'success' => true
            ],200);
        }catch (Exception $e){
            return response([
                'success' => false
            ],404);
        }
    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:50',
        ]);

        try {
            $token = LoginCommander::login($validatedData);
            return response([
                'success' => true,
                'token' => $token
            ],200);
        }catch (Exception $e){
            return response([
                'success' => false
            ],404);
        }
    }
}
