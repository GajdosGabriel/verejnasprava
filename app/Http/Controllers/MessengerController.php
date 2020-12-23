<?php

namespace App\Http\Controllers;

use App\Models\Messenger;
use App\Models\User;
use Illuminate\Http\Request;

class MessengerController extends Controller
{

    public function index()
    {
        return auth()->user()->messengers;
    }

    public function store(Request $request)
    {
      $message =  Messenger::create([
            'organization_id' => auth()->user()->active_organization,
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
            'type' => 'message',
        ]);

        foreach($request->input('recipients') as $recipient){
            $user = User::find($recipient['id']);
            $user->messengers()->attach($message->id);
        }

    }
}
