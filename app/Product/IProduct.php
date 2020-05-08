<?php

use App\ProductPriceType;
use App\ProductType;

interface iProduct{
    public static function getWithTypeAndPriceFilters(ProductPriceType $priceType, ProductType $productType);
}


