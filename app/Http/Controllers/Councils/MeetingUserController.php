<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingUserController extends Controller
{
    public function store(Request $request, Meeting $meeting)
    {
        $meeting->users()->attach($request->input('user'));
    }

    public function destroy(Request $request, Meeting $meeting)
    {
        $meeting->users()->detach($request->input('user'));
    }
}
