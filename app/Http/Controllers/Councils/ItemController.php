<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Meeting;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create(Meeting $meeting) {
        return view('council.meeting_item.create');
    }
}
