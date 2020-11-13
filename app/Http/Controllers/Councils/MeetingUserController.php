<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingUserController extends Controller
{
    public function update(Request $request, Meeting $meeting)
    {
        $meeting->users()->detach($request->input('user'));
    }

    public function store(Request $request)
    {
        $meeting = Meeting::findOrFail($request->input('id'));
        $meeting->users()->attach($request->input('user'));
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->users()->detach();
    }
}
