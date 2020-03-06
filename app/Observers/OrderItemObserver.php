<?php

namespace App\Observers;

use App\OrderItem;

class OrderItemObserver
{
    public function saving(OrderItem $orderItem)
    {
        // price TOTAL in item-row
        $orderItem->price_total = $orderItem->price_with_vat * $orderItem->quantity;
    }
}
