<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Council\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(Invitation $invitation)
    {
        dd($invitation);
        return back();
    }
}
