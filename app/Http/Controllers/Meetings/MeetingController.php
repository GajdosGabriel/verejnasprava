<?php

namespace App\Http\Controllers\Meetings;


use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function show(Meeting $meeting){
        return view('council.meeting.show', compact('meeting') );
    }

    public function edit(Meeting $meeting){
        return view('council.meeting.edit', compact('meeting') );
    }


    public function update(Request $request, Meeting $meeting) {
        $meeting->update(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));
        $meeting->saveFile($request);
        return redirect()->route('meetings.show', $meeting->id);
    }


    public function destroy(Meeting $meeting) {
        $meeting->delete();
    }


    public function pozvankaPdf(Meeting $meeting) {
        $pdf = \PDF::loadView('council.meeting.print', compact('meeting'));
        return $pdf->stream();
    }
}
