<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Council\Meeting;
use App\Http\Controllers\Controller;
use App\Http\Resources\MeetingResource;
use App\Notifications\Invitation\InvitationForUser;
use Carbon\Carbon;

class MeetingInvitationController extends Controller
{
    public function index(Meeting $meeting)
    {
        return $meeting->invitations()->get();
    }

    public function update(Meeting $meeting, Request $request)
    {
        // Notify for single user
        $invitation =  $meeting->invitations()->updateOrCreate(
            ['user_id' => $request->user_id],
            ['send_at' => Carbon::now()]
        );

        $invitation->user->notify(new InvitationForUser($invitation));

        return Response('Pozvánka na zasadnutie bola odoslaná.');
    }



    public function store(Meeting $meeting, Request $request)
    {

        // Notify for all users
        if ($request->allUsers) {
            foreach ($meeting->council->users as $user) {
                $invitation = $meeting->invitations()->create([
                    'user_id' => $user->id,
                    'send_at' => Carbon::now()
                ]);

                // $invitation->user->notify(new InvitationForUser($invitation));
            }
        }

        // return Response('Pozvánka na zasadnutie bola odoslaná.');
        return new MeetingResource($meeting);
    }
}
