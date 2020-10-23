<?php

namespace App\Observers;


use App\Models\User;
use App\Notifications\User\NewUserCreated;
use Illuminate\Support\Str;

class UserObserver
{

    public function saving(User $user)
    {
        $user->slug = Str::slug($user->first_name .' '.$user->last_name, '-');
    }

    public function created(User $user)
    {
        User::first()->notify(new NewUserCreated($user));
    }


}
