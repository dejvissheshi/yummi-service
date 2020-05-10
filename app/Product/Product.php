<?php

namespace App\Product;

use App\ProductPriceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use iProduct;


class Product extends Model implements iProduct
{
    public $timestamps = false;

    protected $fillable = [
        'product_name', 'product_type', 'price_euro', 'price_dollar', 'description', 'photo'
    ];

    public static function getWithTypeAndPriceFilters($priceType = null,$productType =null):array
    {
        if(!$priceType){
            $priceColumn = 'price_euro';
        }else{
            $priceColumn = $priceType === ProductPriceType::EURO ? 'price_euro' : 'price_dollar';
        }

        $data = !$productType ?
            DB::table('products')
                ->select(['id','product_name', 'product_type', $priceColumn, 'description', 'photo'])->get()->all()
            :
            DB::table('products')
                ->where('product_type', $productType)
                ->select(['id','product_name', 'product_type', $priceColumn, 'description', 'photo'])->get()->all();

        return !$data ? [] : $data;
    }
}


