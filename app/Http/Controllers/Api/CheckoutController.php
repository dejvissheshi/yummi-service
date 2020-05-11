<?php


namespace App\Http\Controllers\Api;

use App\Domain\GetCheckoutInformationQuery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;


class CheckoutController extends Controller
{
    public function getCheckoutInformation(Request $request){
        $request->validate([
            'price_type' => 'in:euro,dollar',
            'products' => 'array|required',
            'products.*.quantity' => 'required|integer',
            'products.*.id' => 'required|integer'

        ]);
        try {
            $priceType = $request->input('price_type');
            $products = $request->input('products');

            $data = GetCheckoutInformationQuery::getInformationQuery($priceType,$products);
            return response([
                'success' => true,
                'data' => $data
            ],200);
        }catch (Exception $e){

            return response([
                'success' => false
            ], 404);
        }
    }
}
