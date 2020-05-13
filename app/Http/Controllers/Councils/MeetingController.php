<?php

namespace App\Http\Controllers\Councils;

use App\Models\Council\Council;
use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use App\Models\User;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(Council $council) {
        return view('council.meeting.index', compact('council'));
    }

    public function create(Council $council){
        $meeting = new Meeting();
        return view('council.meeting.create', compact(['council', 'meeting']) );
    }

    public function edit(Meeting $meeting){
        return view('council.meeting.edit', compact('meeting') );
    }


    public function update(Request $request, Meeting $meeting) {
        $meeting->update(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));
        $meeting->saveFile($request);
        return redirect()->route('meet.index', [$meeting->id, $meeting->slug]);
    }

    public function store(Request $request, Council $council) {
        $meeting = $council->meetings()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));
        $meeting->saveFile($request);
        return redirect()->route('meet.index', [$council->id, $council->slug]);
    }

    public function delete(Meeting $meeting) {
        $meeting->delete();
        return back();
    }

    public function published(Meeting $meeting) {

        $meeting->published();
        return back();
    }
}
