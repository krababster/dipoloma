<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get("/products",[ProductController::class,"getProducts"]);
//Route::get("/products/{product_id}",[ProductController::class,"getProduct"]);
//
//Route::post("/products",[ProductController::class,"addProduct"]);
//
//Route::put("/products/{product_id}",[ProductController::class,"changeProducts"]);
//
//Route::patch("/products/{product_id}",[ProductController::class,"changeProduct"]);
//
//Route::delete("/products/{product_id}",[ProductController::class,"deleteProduct"]);

Route::resource('products',ProductsController::class);
