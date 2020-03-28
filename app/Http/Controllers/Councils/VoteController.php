<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function voteEnable(Item $item) {
        $item->voteEnable();
        return back();
    }
    public function store(Request $request, Item $item){
        $item->users()->detach(auth()->user()->id, ['vote' => $request->input('vote')] );
        $item->users()->attach(auth()->user()->id, ['vote' => $request->input('vote')] );
//        $item->users()->attach(auth()->user()->id, ['vote' => $request->input('vote')] );
        return back();
    }
}
