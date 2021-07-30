<?php

namespace App\Observers;

use App\Models\Council\Invitation;
use App\Notifications\Invitation\InvitationForUser;

class InvitationObserver
{
    public function created(Invitation $invitation)
    {
        $invitation->user->notify(new InvitationForUser($invitation->user, $invitation->meeting));
    }
}
