<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){
        $products = Product::all();

        return response()->json($products);
    }

    public function getProduct($product_id){
        $product = Product::find($product_id);

        return response()->json($product);
    }
}
