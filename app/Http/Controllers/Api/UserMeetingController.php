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
        // Zlá funkcia berie iba jeden council

        foreach($user->councils as $council){
          $meeting = $council->meetings->where('start_at', '>=', Carbon::now())->where('published', '=', 1)
          ->sortBy('start_at')
          ->take(1);
        }

        return $meeting;
    }
}
