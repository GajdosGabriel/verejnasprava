<?php

namespace App\Http\Controllers\Councils;

use App\Models\Council\Council;
use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
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
        $meeting = $council->meetings()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));
        $meeting->saveImage($request);
        return back();
    }
}
