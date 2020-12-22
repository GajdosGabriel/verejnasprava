<?php

namespace App\Http\Controllers;

use App\Models\Messenger;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function store(Request $request){
//        dd($request->input('tags'));
        Messenger::create([
           'organization_id' => auth()->user()->active_organization,
           'name' => $request->input('name'),
           'body' => $request->input('body'),
           'type' => 'message',
        ]);

    }
}
