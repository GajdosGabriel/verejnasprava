<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;
use App\Notifications\Meeting\NewMeeting;
use Carbon\Carbon;

class MeetingInvitationController extends Controller
{
    public function store(Meeting $meeting, Request $request){

        // dd($request->all());

        // if ($request->has('allUsers')) {
            foreach ($meeting->council->users as $user) {
                $meeting->invitations()->create([
                    'send_at' => Carbon::now(),
                    'user_id' =>  $user->id,
                ]);
                $user->notify(new NewMeeting($user, $meeting));
            // }
            return Response('Pozvánka na zasadnutie bola odoslaná.');
        }

    }
}
