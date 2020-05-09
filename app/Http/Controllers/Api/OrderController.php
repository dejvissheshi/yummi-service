<?php


namespace App\Http\Controllers\Api;

use App\Domain\GetClientOrdersQuery;
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

    public function getClientOrders(Request $request, string $token){
        $priceType = $request->input('price_type');
        try{
            $orders = GetClientOrdersQuery::getAuthenticatedClientOrders($token, $priceType);
            return response([
                'success'=> true,
                'data'=> $orders
            ],200);
        }catch (Exception $e){
            return response([
                'success'=>false
            ],404);
        }
    }
}
