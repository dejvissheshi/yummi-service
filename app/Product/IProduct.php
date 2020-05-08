<?php

use App\ProductPriceType;
use App\ProductType;

interface iProduct{
    public function getWithTypeAndPriceFilters(ProductPriceType $priceType, ProductType $productType);
}


