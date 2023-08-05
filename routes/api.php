<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/products",[ProductController::class,"getProducts"]);
Route::get("/products/{product_id}",[ProductController::class,"getProduct"]);

Route::post("/products",[ProductController::class,"addProduct"]);

//Route::put("/products/{product_id}",[ProductController::class,"changeProduct"]);


Route::put("/putProducts/{product_id}",[ProductController::class,"changeProduct"]);

