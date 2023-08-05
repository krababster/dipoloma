<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $request_data = $request->only(["product_name","product_price","product_compound","category_id"]);

        $validator = Validator::make($request_data,[
            "product_name"=>["required","string"],
            "product_price"=>["required","integer"],
            "product_compound"=>["required","string"],
            "category_id"=>["required","integer"],
        ]);

        if($validator->fails()){
            return response()->json([
                "status"=>"false",
                "errors"=>$validator->messages()
            ],422 );
        }

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

    public function changeProducts($product_id,Request $request){

        $request_data = $request->only(["product_name","product_price","product_compound","category_id"]);
        $validator = Validator::make($request_data,[
            "product_name"=>["required","string"],
            "product_price"=>["required","integer"],
            "product_compound"=>["required","string"],
            "category_id"=>["required","integer"],
        ]);

        if($validator->fails()){
            return response()->json([
                "status"=>"false",
                "errors"=>$validator->messages()
            ],422 );
        }

        $product = Product::find($product_id);

        if(!$product){
            return response()->json([
                "status"=>false,
                "message"=>"Product not found"
            ],404);
        }

        $product->product_name = $request_data["product_name"];
        $product->product_price = $request_data["product_price"];
        $product->product_compound = $request_data["product_compound"];
        $product->category_id = $request_data["category_id"];

        $product->save();

        return response()->json([
            "status"=>true,
            "message"=>"Product was updated"
        ],200);


    }

    public function changeProduct($product_id,Request $request){
        $request_data = $request->only(["product_name","product_price","product_compound","category_id"]);


        if(count($request_data) === 0)
        {
            return response()->json([
                "status"=>false,
                "message"=>"All fields are empty"
            ])->setStatusCode(422,"All fields are empty");
        }
        $rules_const = [
            "product_name"=>["required","string"],
            "product_price"=>["required","integer"],
            "product_compound"=>["required","string"],
            "category_id"=>["required","integer"],
        ];
        $rules = [];

        foreach ($request_data as $key=>$value){
            $rules[$key] = $rules_const[$key];
        }

        $validator = Validator::make($request_data,$rules);

        if($validator->fails()){
            return response()->json([
                "status"=>"false",
                "errors"=>$validator->messages()
            ],422 );
        }

        $product = Product::find($product_id);

        if(!$product){
            return response()->json([
                "status"=>false,
                "message"=>"Product not found"
            ],404);
        }
        foreach ($request_data as $key=>$value){
            $product->$key = $value;
        }

        $product->save();

        return response()->json([
            "status"=>true,
            "message"=>"Product was updated"
        ],200);


    }



}
