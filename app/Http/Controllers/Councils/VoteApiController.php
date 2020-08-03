<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class VoteApiController extends Controller
{
    public function voteEnable(Item $item)
    {
        // only published item can be voted
        if ($item->published == 0) {
            session()->flash('flash', 'Položka nie je publikovaná!');
            return back();
        }

        // Enable vote can only if interpelations list is empty
        if ($item->interpellations()->count() > 0) {
            session()->flash('flash', 'Zoznam prihlásených do rozpravy nie je prázdny!');
            return back();
        }

        $item->voteDisable();

        return back();
    }

    public function store(Request $request, Item $item)
    {
     $myVote =   $item->votes()->whereUserId($request->userId)->updateOrCreate([
            'user_id' => $request->userId,
        ], [
            'vote' => $request->vote
        ]);

        return $myVote;
    }
}
