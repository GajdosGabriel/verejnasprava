<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;
use App\Http\Resources\MeetingResource;
use App\Models\Council\Council;

class CouncilMeetingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Meeting::class, 'meeting');
    }

    public function show(Council $council, Meeting $meeting)
    {
        return new MeetingResource($meeting);
    }

    public function update(Council $council, Meeting $meeting, Request $request,)
    {
        $meeting->update($request->all());

        return new MeetingResource($meeting);
    }

    public function destroy(Council $council, Meeting $meeting) {
        $meeting->delete();
    }

}
