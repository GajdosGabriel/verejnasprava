<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function show(Meeting $meeting){
        return $meeting->items()->get();
    }

    public function update(Request $request, Meeting $meeting){
        $meeting->update($request->all());
        return $meeting;
    }
}
