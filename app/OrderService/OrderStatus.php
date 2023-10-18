<?php

namespace App\OrderService;

enum OrderStatus: string
{
    case NEW = 'NEW';
    case FULLFILLED = 'FULLFILLED';
}
