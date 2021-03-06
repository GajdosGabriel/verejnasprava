<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Interpellation;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class InterpellationController extends Controller
{
    public function update(Item $interpellation)
    {

        if ($int = $interpellation->interpellations()->withTrashed()->whereUserId(auth()->user()->id)->first()) {

            if ( $int->deleted_at == null) {
                $int->delete();

            } else {
                $int->restore();
            }
            return $interpellation->interpellations()->get();
        }
        $interpellation->interpellations()->create([
            'name' => 'Prihlásený do rozpravy',
            'body' => $interpellation->name,
            'user_id' => auth()->user()->id,
        ]);
//        return $int;
//        return $item->interpellations()->get();
    }

    public function destroy(Interpellation $interpellation){
        $interpellation->update(['hand_up' => $interpellation->hand_up +1]);
        $interpellation->delete();
    }
}
