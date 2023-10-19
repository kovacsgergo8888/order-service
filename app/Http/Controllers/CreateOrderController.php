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
            'shipping_type' => ShippingType::from($data['shippingType'])->value,
            'shipping_name' => $data['shippingName'],
            'shipping_postcode' => $data['shippingPostcode'],
            'shipping_city' => $data['shippingCity'],
            'shipping_address' => $data['shippingAddress'],
            'billing_name' => $data['billingName'],
            'billing_postcode' => $data['billingPostcode'],
            'billing_city' => $data['billingCity'],
            'billing_address' => $data['billingAddress'],
        ]);

        $order->orderProducts()->createMany($data['orderProducts']);

        return response()->json(['order_id' => $order->order_id]);
    }
}
