<?php

namespace App\Http\Controllers\Api;

use App\Models\Council\Item;
use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;

class MeetingItemController extends Controller
{
    public function store(Request $request, Meeting $meeting)
    {
        $item = $meeting->items()->create(array_merge($request->except('filename'), [
            'user_id' => auth()->user()->id,
            'organization_id' => auth()->user()->active_organization,
        ]));

        $item->saveFile($request);
        return redirect()->route('meetings.show', $meeting->id);
    }

    public function destroy($meeting , Item $item) {
        $item->meetings()->detach();
    }
}
