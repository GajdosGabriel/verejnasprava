<?php

namespace App\Observers;

use App\Models\Council\Item;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{

    public function saving(User $user)
    {
        $user->slug = Str::slug($user->first_name .' '.$user->last_name, '-');
    }

    public function created(User $user)
    {
        $user->organizations()->attach(auth()->user()->active_organization);
    }


}
