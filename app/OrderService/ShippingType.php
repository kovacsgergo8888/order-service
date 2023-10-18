<?php
namespace App\OrderService;

enum ShippingType: string
{
    case PICK_UP_AT_STORE = 'PICK_UP_AT_STORE';
    case COURIER_SHIPPING = 'COURIER_SHIPPING';
}
