<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\OrderService\OrderStatus;
use App\OrderService\ShippingType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return new JsonResponse(['orderId' => $order->order_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function status(Request $request, string $orderId): JsonResponse
    {
        $data = $request->toArray();

        $order = Order::find($orderId);
        $order->status = OrderStatus::from($data['status'])->value;
        $order->save();
        return new JsonResponse($order);
    }
}
