<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function voteEnable(Item $item) {
        // only published item can be voted
        if( $item->published  == 1) {
        $item->voteDisable();
            return back();
        }
        session()->flash('flash', 'Najprv zapnite publikovanie položky!');
        return back();
    }
    public function store(Request $request, Item $item){
        $item->users()->detach(auth()->user()->id, ['vote' => $request->input('vote')] );
        $item->users()->attach(auth()->user()->id, ['vote' => $request->input('vote')] );
//        $item->users()->attach(auth()->user()->id, ['vote' => $request->input('vote')] );
        return back();
    }
}
