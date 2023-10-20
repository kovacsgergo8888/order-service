<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OrderService\OrderStatus;
use App\OrderService\ShippingType;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->toArray();
        $order = Order::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => OrderStatus::NEW->value,
            'shipping_type' => ShippingType::from($data['shipping_type'])->value,
            'shipping_name' => $data['shipping_name'],
            'shipping_postcode' => $data['shipping_postcode'],
            'shipping_city' => $data['shipping_city'],
            'shipping_address' => $data['shipping_address'],
            'billing_name' => $data['billing_name'],
            'billing_postcode' => $data['billing_postcode'],
            'billing_city' => $data['billing_city'],
            'billing_address' => $data['billing_address'],
        ]);

        $order->orderProducts()->createMany($data['order_products']);

        return response()->json(['order_id' => $order->order_id]);
    }
}
