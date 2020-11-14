<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class ItemMeetingController extends Controller
{
    public function create(Meeting $meeting) {
        return view('council.meeting.createItem', compact('meeting'));
    }

    public function update(Request $request, $meeting = null , Item $item) {

        $item->meetings()->attach($request->meeting);

        return  back();
    }

    public function store(Request $request, Meeting $meeting) {

       $item = $meeting->items()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

        $item->saveFile($request);
        return redirect()->route('meetings.show', $meeting->id);
    }

    public function destroy($meeting = null, Item $item) {
        $item->meetings()->detach();
    }
}
