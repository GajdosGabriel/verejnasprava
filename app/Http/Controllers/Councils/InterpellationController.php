<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class InterpellationController extends Controller
{
    public function store(Item $item)
    {
        if ($interpellation = $item->interpellations()->whereUserId(auth()->user()->id)->first()) {

            if ($interpellation->status == 0) {
                $interpellation->update(['status' => 1]);
            } else {
                $interpellation->update(['status' => 0]);
            }
            return back();
        }
        $item->interpellations()->create([
            'name' => 'Prihlásený do rozpravy',
            'body' => $item->name,
            'user_id' => auth()->user()->id,
        ]);
        return back();
    }
}
