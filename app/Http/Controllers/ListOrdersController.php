<?php

namespace App\Http\Controllers;

use App\Models\ListOrdersQueryBuilder;
use App\Models\Order;
use Illuminate\Http\Request;

class ListOrdersController extends Controller
{
    public function __invoke(Request $request, ListOrdersQueryBuilder $queryBuilder)
    {
        $data = $request->toArray();

        $query = Order::query();

        $queryBuilder->build($query, $data);

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
