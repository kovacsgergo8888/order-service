<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OrderService\OrderStatus;
use App\OrderService\ShippingType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
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

        return new JsonResponse(['order_id' => $order->order_id]);
    }

    public function status(Request $request, string $orderId): JsonResponse
    {
        $data = $request->toArray();

        $order = Order::find($orderId);
        $order->status = OrderStatus::from($data['status'])->value;
        $order->save();
        return new JsonResponse($order);
    }

    public function list(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $query = Order::query();

        if ($data['order_id'] ?? false) {
            $query->where('order_id', $data['order_id']);
        }

        if ($data['created_after'] ?? false) {
            $query->where('created_at', '>=', $data['created_after']);
        }

        if ($data['created_before'] ?? false) {
            $query->where('created_before', '<=', $data['created_before']);
        }

        if ($data['status'] ?? false) {
            $query->where('status', OrderStatus::from($data['status'])->value);
        }

        return response()->json($query->paginate(100));
    }
}
