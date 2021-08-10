<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserMeetingController extends Controller
{
    public function index(User $user)
    {
        foreach($user->councils as $council){
            $meetings[] = $council->meetings->where('start_at', '>=', Carbon::now())->where('published', '=', 1);
          }
          $meeting = collect($meetings)->flatten(1)->sortBy('start_at') ->take(1)->first();

        return $meeting;
    }
}
