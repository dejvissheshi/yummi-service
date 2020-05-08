<?php


namespace App\Http\Controllers;

use App\Product;

class ProductsQuery
{
    public static function getProductsQuery ($productType = null, $priceType = null )
    {
        $product = new Product();
        return $product->getWithTypeAndPriceFilters($priceType, $productType);
    }
}
