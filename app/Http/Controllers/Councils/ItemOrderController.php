<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class ItemOrderController extends Controller
{

    public function position(Request $request)
    {
        $postData = $this->validate($request,
            [
                'items' => 'required|array'
            ]);

        foreach($postData['items'] as $key => $item){
           $item = Item::find($item['id']);
           $item->update([
               'position' => $key + 1,
           ]);
        }
    }

}
