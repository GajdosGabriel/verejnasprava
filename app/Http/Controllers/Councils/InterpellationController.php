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
//        dd($interpellation);

        if ($int = $interpellation->interpellations()->withTrashed()->whereUserId(auth()->user()->id)->first()) {

            if ( $int->deleted_at == null) {
                $int->delete();

            } else {
                $int->restore() ;
            }
            return $interpellation->interpellations()->get();
        }
        $interpellation->interpellations()->create([
            'name' => 'Prihlásený do rozpravy',
            'body' => $int->name,
            'user_id' => auth()->user()->id,
        ]);
        return $int;
//        return $item->interpellations()->get();
    }

    public function destroy(Interpellation $interpellation){
        $interpellation->delete();
    }
}
