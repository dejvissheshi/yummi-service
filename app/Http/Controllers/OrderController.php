<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
 public function getPizzaQuery(){
     $pizzas = DB::select('select * from Product where product_type =\'pizza\'');
     return [
         "pizza" => $pizzas
     ];
 }
}
