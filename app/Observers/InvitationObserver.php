<?php

namespace App\Observers;

use App\Models\Council\Invitation;
use App\Notifications\Meeting\NewMeeting;

class InvitationObserver
{
    public function created(Invitation $invitation)
    {
        $invitation->user->notify(new NewMeeting($invitation->user, $invitation->meeting));
    }
}
