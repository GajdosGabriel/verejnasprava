<?php

namespace App\Http\Controllers\Councils;

use App\Models\Council\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemOrderController extends Controller
{
    public function ItemUp(Item $item){

        $itemUp = Item::whereMeetingId($item->meeting_id)->orderBy('order', 'asc')->where('order', '<', $item->order)->first();

        session()->put('itemUp',  $itemUp->order);
        session()->put('itemDown',  $item->order);


        $item->update(['order' =>  session('itemUp')]);
        $itemUp->update(['order' =>  session('itemDown')]);



        return back();
    }

    public function ItemDown(Item $item){

        $itemUp = Item::whereMeetingId($item->meeting_id)->orderBy('order', 'asc')->where('order', '>', $item->order)->first();

        session()->put('itemUp',  $itemUp->order);
        session()->put('itemDown',  $item->order);


        $item->update(['order' =>  session('itemUp')]);
        $itemUp->update(['order' =>  session('itemDown')]);


        return back();
    }


}
