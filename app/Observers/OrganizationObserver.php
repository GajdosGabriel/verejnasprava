<?php

namespace App\Observers;

use App\Organization;
use Illuminate\Support\Str;

class OrganizationObserver
{
    public function saving(Organization $organization){
        $organization->slug = Str::slug($organization->name, '-');
    }

    public function created(Organization $organization) {
        auth()->user()->update([ 'active_organization' => $organization->id]);
    }
}
