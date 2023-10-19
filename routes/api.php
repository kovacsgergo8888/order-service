<?php

use App\Http\Controllers\ChangeOrderStatusController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\ListOrdersController;
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

Route::post('/orders', CreateOrderController::class);
Route::post('/order/{orderId}/status', ChangeOrderStatusController::class);
Route::post('/orders/list', ListOrdersController::class);
