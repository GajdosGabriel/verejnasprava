<?php

namespace App\Observers;

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
        // Create super admin access
        if($user->id == 1)
            // $user->givePermissionTo('role-list');
            $user->assignRole('superadmin');
    }
}
