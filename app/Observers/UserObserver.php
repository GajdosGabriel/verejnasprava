<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Str;

class UserObserver
{

    public function saving(User $user)
    {
        $user->slug = Str::slug($user->first_name .' '.$user->last_name, '-');
    }
}
