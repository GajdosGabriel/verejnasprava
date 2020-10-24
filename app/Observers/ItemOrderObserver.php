<?php

namespace App\Observers;

use App\Models\Council\Item;

class ItemOrderObserver
{
    public function created(Item $item)
    {
        $item->update(['position' => $item->id]);
    }
}
