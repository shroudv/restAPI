<?php

use App\Http\Controllers\Front\Api\categoryController;
use App\Http\Controllers\Front\Api\productController;
use App\Http\Controllers\Front\Api\sliderController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products',[productController::class,'index']);
Route::get('/products/{slug}',[productController::class,'show']);
Route::get('/sliders',[sliderController::class,'index']);
Route::get('/categories',[categoryController::class,'index']);
Route::get('/categories/{slug}',[categoryController::class,'show']);