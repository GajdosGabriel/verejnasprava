<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Council;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class CouncilMeetingController extends Controller
{
    public function create(Council $council){
        $meeting = new Meeting();
        return view('council.meeting.create', compact(['council', 'meeting']) );
    }

    public function store(Request $request, Council $council) {
        $meeting = $council->meetings()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));
        $meeting->saveFile($request);
        return redirect()->route('meetings.show', $meeting->id);
    }
}
