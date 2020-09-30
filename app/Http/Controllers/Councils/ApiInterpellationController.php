<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Interpellation;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class ApiInterpellationController extends Controller
{
    public function getIndex(Item $itemId) {
        return $itemId->interpellations()->get();
    }

    public function store(Item $item, Request $request)
    {
        if ($interpellation = $item->interpellations()->withTrashed()->whereUserId($request->user)->first()) {

            if ( $interpellation->deleted_at == null) {
                $interpellation->delete();

            } else {
                $interpellation->restore() ;
            }
            return $item->interpellations()->get();
        }
        $item->interpellations()->create([
            'name' => 'Prihlásený do rozpravy',
            'body' => $item->name,
            'user_id' => auth()->user()->id,
        ]);
        return $item->interpellations()->get();
    }
    public function delete(Interpellation $interpellation){
        $interpellation->delete();
    }
}
