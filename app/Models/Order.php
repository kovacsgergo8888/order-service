<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'name',
        'email',
        'status',
        'shipping_type',
        'shipping_name',
        'shipping_postcode',
        'shipping_city',
        'shipping_address',
        'billing_name',
        'billing_postcode',
        'billing_city',
        'billing_address',
        'order_products',
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function orderTotal(): Attribute
    {
        return Attribute::make(
            get: fn() => array_reduce(
                $this->orderProducts()->get()->all(),
                fn($carry, $orderProduct) => $carry += $orderProduct->price * $orderProduct->quantity,
                0
            )
        );
    }
}
