<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;

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
