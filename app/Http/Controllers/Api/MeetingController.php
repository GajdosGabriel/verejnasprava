<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Models\Council\Meeting;
use App\Notifications\Meeting\NewMeeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function show(Meeting $meeting){
        return $meeting;
    }

    public function update(Request $request, Meeting $meeting){
        $meeting->update($request->all());

        if ($request->has('notification')){
            foreach ($meeting->council->users as $user){
                $user->notify(new NewMeeting($user, $meeting));
            }
            return Response( 'Pozvánka na rokovanie bola odoslovaná.');
        }
        return $meeting;
    }

}
