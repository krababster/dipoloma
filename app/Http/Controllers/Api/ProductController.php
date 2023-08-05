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

        if(!$product){
            return response()->json([
                "status"=>"false",
                "message"=>"Product not found"
            ],404);
        }
        return response()->json($product);
    }

    public function addProduct(Request $request){
        $product = Product::create([
           "product_name"=>$request->product_name,
           "product_price"=>$request->product_price,
           "product_compound"=>$request->product_compound,
           "category_id"=>$request->category_id
        ]);

        return response()->json([
            "status"=>"true",
            "product"=>$product
        ]);
    }



}
