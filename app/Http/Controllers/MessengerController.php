<?php

namespace App\Http\Controllers;

use App\Models\Messenger;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class MessengerController extends Controller
{

    public function index()
    {
        return auth()->user()->messengers()->paginate(10);
    }

//    public function show($messenger)
//    {
//        return auth()->user()->messengers()->paginate(10);
//    }

    public function update(Messenger $messenger, Request $request)
    {
        $messenger->users()->updateExistingPivot(auth()->id(), ['opened' => \Carbon\Carbon::now()]);
        $messenger->saveFile($request);
    }

    public function store(Request $request)
    {
//        dd($request->all());
      $message =  Messenger::create([
            'organization_id' => auth()->user()->active_organization,
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
            'type' => 'official',
        ]);

        foreach($request->input('recipients') as $recipient){
            $user = User::find($recipient['id']);
            $user->messengers()->attach($message->id);
        }

        $message->saveFile($request);

    }

    public function destroy(Messenger $messenger){
        $messenger->users()->updateExistingPivot(auth()->id(), ['deleted_at' => \Carbon\Carbon::now()]);
    }
}
