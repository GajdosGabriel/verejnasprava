<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Council\Invitation;
use App\Http\Controllers\Controller;

class InvitationController extends Controller
{
    public function show(Invitation $invitation)
    {
        $invitation->update([
           'confirmed_at' => Carbon::now()
        ]);
        // session()->flash('flash', 'Položka nie je publikovaná!');

        return redirect()->route('meetings.show', $invitation->meeting->id);
    }

    public function update(Invitation $invitation, Request $request)
    {
        // Notify for single user
        $invitation->update($request->all());

        // $invitation->user->notify(new InvitationForUser($invitation));

        return Response('Pozvánka na zasadnutie bola odoslaná.');
    }
}
