<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function show(Meeting $meeting)
    {
        return $meeting;
    }

    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        return $meeting;
    }
}
