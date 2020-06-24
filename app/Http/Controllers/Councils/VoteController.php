<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function voteEnable(Item $item)
    {
        // only published item can be voted
        if ($item->published == 0) {
            session()->flash('flash', 'Položka nie je publikovaná!');
            return back();
        }

        // Enable vote can only if interpelations list is empty
        if ($item->interpellations()->whereStatus(1)->count() > 0) {
            session()->flash('flash', 'Máte prihlásených do rozpravy!');
            return back();
        }

        $item->voteDisable();

        return back();
    }

    public function store(Request $request, Item $item)
    {
        $item->votes()->whereUserId(auth()->user()->id)->updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'vote' => $request->input('vote')
        ]);

        return back();
    }
}

