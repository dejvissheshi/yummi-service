<?php


namespace App\Http\Controllers\Api;
use App\Domain\ProductsQuery;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            logger('ERROR'. $e->getTraceAsString());
            return[
                'success' => false
            ];
        }


    }
}
