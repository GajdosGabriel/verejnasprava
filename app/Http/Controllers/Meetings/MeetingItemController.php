<?php

namespace App\Http\Controllers\Meetings;

use App\Models\Council\Item;
use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;

class MeetingItemController extends Controller
{
    public function create(Meeting $meeting) {
        return view('council.meeting.createItem', compact('meeting'));
    }

}
