<?php


namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder (Request $request){

        $validatedData = $request->validate([
            'status' => 'required|',
            'delivery_time' => 'required',
            'client_id' => '',
            'product_ids.*.quantity' => 'required',
            'product_ids.*.product_id' => 'required'
        ]);

        try {



            return[
                'success' => true
            ];
        }catch (Exception $e){
            return[
                'success' => false
            ];
        }
    }
}
