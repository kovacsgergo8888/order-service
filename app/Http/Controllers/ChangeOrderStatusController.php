<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OrderService\OrderStatus;
use Illuminate\Http\Request;

class ChangeOrderStatusController extends Controller
{
    public function __invoke(Request $request, string $orderId)
    {
        $data = $request->toArray();

        $order = Order::find($orderId);
        $order->status = OrderStatus::from($data['status'])->value;
        $order->save();
        return response()->json($order);
    }
}
