<?php

namespace App\Http\Controllers\Councils;

use App\Models\Council\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemOrderController extends Controller
{
    public function ItemUp(Item $item){
        if($item->order > 1){

      $itemBefore =  Item::whereMeetingId($item->meeting_id)->whereOrder($item->order - 1)->first();
        $item->decrement('order');
        $itemBefore->increment('order');
        }

        return back();
    }

    public function ItemDown(Item $item){
        if($itemBefore = Item::whereMeetingId($item->meeting_id)->whereOrder($item->order + 1)->first()){
        $item->increment('order');
        $itemBefore->decrement('order');
        }

        return back();
    }


}
