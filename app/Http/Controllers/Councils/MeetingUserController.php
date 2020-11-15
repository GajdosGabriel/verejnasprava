<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingUserController extends Controller
{
    public function update(Meeting $meeting, $user = null, Request $request )
    {
        $meeting->users()->detach($request->input('user'));
    }

    public function store(Meeting $meeting, Request $request)
    {
        $meeting->users()->attach($request->input('user'));
    }

    public function destroy(Meeting $meeting, $user = null)
    {
        $meeting->users()->detach();
    }
}
