<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index() {
        return view('council.meeting.index');
    }
}
