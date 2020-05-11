<?php

namespace App\Domain;

use App\ProductPriceType;
use Exception;


class GetCheckoutInformationQuery
{
    public static function getInformationQuery($priceType, $productData)
    {
        $priceType = !$priceType ? ProductPriceType::EURO : $priceType;

        try {
            if(!$productData)
                throw new Exception('Invalid product data');

            $idToQuantityList = [];
            $orderedProductIds = [];

            foreach ($productData as $productDatum){
                logger($productDatum);
                $idToQuantityList[$productDatum['id']] = $productDatum['quantity'];
                array_push($orderedProductIds, $productDatum['id']);
            }
            $products = GetClientOrdersQuery::getOrderProducts($orderedProductIds);

            $data = [];
            $totalSum = 0;
            foreach ($products as $product){
                $singleOrder['id'] = $product->id;
                $singleOrder['quantity'] = $idToQuantityList[$product->id];
                $singleOrder['product_name'] = $product->product_name;
                $singleOrder['product_type'] = $product->product_type;

                $priceType === ProductPriceType::EURO ?
                    $singleOrder['price'] = $product->price_euro :
                    $singleOrder['price'] = $product->price_dollar;
                    $totalSum += $singleOrder['price'] * $singleOrder['quantity'];
                if (isset($product->photo)) {
                    $singleOrder['photo'] = $product->photo;
                }
                array_push($data, $singleOrder);
            }

            $transport = self::calculateTransportationCost($totalSum);

            return [
                'products' => $data,
                'total' => $totalSum + $transport,
                'subtotal' => $totalSum,
                'transport' => $transport
            ];

        }catch (Exception $e){
            throw new Exception('There was a problem getting checkout information!');
        }
    }

    static function calculateTransportationCost($totalSum):float {
        if ($totalSum < 20){
            return 2;
        }elseif ($totalSum < 50){
            return $totalSum * 0.1;
        }else{
            return 0;
        }
    }
}
