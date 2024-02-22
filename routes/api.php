<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InventoryController;
use App\Http\Controllers\Api\V1\LineItemController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//routes for api/v1
Route::group(
    ['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'],
    function (){
        Route::apiResource('customer', CustomerController::class);
        Route::apiResource('inventory', InventoryController::class);
        Route::apiResource('line-item', LineItemController::class);
        Route::apiResource('orders', OrdersController::class);
        Route::apiResource('product', ProductController::class);
        Route::apiResource('warehouse', WarehouseController::class);
    }
);