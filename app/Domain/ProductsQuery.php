<?php


namespace App\Domain;

use App\Product\Product;

class ProductsQuery
{
    public static function getProductsQuery ($productType = null, $priceType = null )
    {
        return Product::getWithTypeAndPriceFilters($priceType, $productType);
    }
}
