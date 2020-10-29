<?php

namespace App\Observers;

use App\Models\Organization;
use Illuminate\Support\Str;

class OrganizationObserver
{
    public function saving(Organization $organization){
        $organization->slug = Str::slug($organization->name, '-');
    }

    public function created(Organization $organization) {
        auth()->user()->update([ 'active_organization' => $organization->id]);
//        auth()->user()->givePermissionTo('posts', 'contacts', 'helps');
        auth()->user()->assignRole('admin');

        $organization->menus()->attach([8,9]);

        //        $user->organizations()->attach(auth()->user()->active_organization);
    }
}
