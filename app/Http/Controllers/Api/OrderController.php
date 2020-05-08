<?php


namespace App\Http\Controllers\Api;

use App\Domain\OrderCommander;
use App\Domain\SingleOrderQuery;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder (Request $request){
        $validatedData = $request->validate([
            'status' => 'required|in:ordered,delivered',
            'delivery_time' => 'required|date_format:Y-m-d H:i:s',
            'client_id' => 'integer',
            'products' => 'array',
            'products.*.quantity' => 'required|integer',
            'products.*.product_id' => 'required|integer'
        ]);

        try {
            OrderCommander::createOrder($validatedData);
            return response([
                'success' => true
            ],200);

        }catch (Exception $e){
            logger("Error: ".$e->getMessage());
            logger("Line: ".$e->getLine());
            return response([
                'success' => false
            ],404);
        }
    }

    public function getSingleOrder(int $id){
        try {
            $order = SingleOrderQuery::getSingleOrder($id);
            return[
                'success' => true,
                'data' => [
                    'order' => $order
                ]
            ];
        }catch (Exception $e){
            return[
                'success' => false
            ];
        }
    }
}
