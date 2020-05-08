<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\ProductsQuery;
use Exception;
use Illuminate\Http\Request;

class ProductController
{
    public function getProducts(Request $request){
        $productType = $request->input('product_type');
        $priceType = $request->input('price_type');

        try {
            $products = ProductsQuery::getProductsQuery($productType, $priceType);

            return [
                'success'=>true,
                'data' => [
                    'products' => $products
                ]
            ];
        }catch (Exception $e){
            logger("Error ".$e->getMessage());
            return[
                'success' => false
            ];
        }


    }
}
