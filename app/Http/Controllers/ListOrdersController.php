<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OrderService\OrderStatus;
use Illuminate\Http\Request;

class ListOrdersController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->toArray();

        $query = Order::query();

        if ($data['order_id'] ?? false) {
            $query->orderId($data['order_id']);
        }

        if ($data['created_after'] ?? false) {
            $query->createdAfter($data['created_after']);
        }

        if ($data['created_before'] ?? false) {
            $query->createdBefore($data['created_before']);
        }

        if ($data['status'] ?? false) {
            $query->status(OrderStatus::from($data['status']));
        }

        $orders = $query->paginate(
            100,
            [
                'order_id',
                'status',
                'name',
                'created_at',
            ]
        );

        foreach($orders as $order) {
            $order->append('order_total');
        }

        return response()->json($orders);
    }
}
