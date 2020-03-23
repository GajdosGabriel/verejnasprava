<?php

namespace App\Http\Controllers\Councils;

use App\Council;
use App\CouncilMeeting;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Organization;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(Council $council) {
        return view('council.meeting.index', compact('council'));
    }

    public function create(Council $council){
//        $council = new Council();
        return view('council.meeting.create', compact('council') );
    }

    public function show(Meeting $council){
        return view('council.meeting.show', compact('council') );
    }

    public function store(Request $request, Council $council) {
        $council->meetings()->create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return back();
    }
}
