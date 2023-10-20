<?php
namespace App\Models;

use App\OrderService\OrderStatus;
use Illuminate\Database\Eloquent\Builder;

class ListOrdersQueryBuilder
{
    public function build(Builder $query, array $data): void
    {
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
    }
}
