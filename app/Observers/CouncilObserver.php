<?php

namespace App\Observers;

use App\Models\Council\Council;
use App\Models\Organization;

class CouncilObserver
{
    public function created(){
       $organization = Organization::whereId(auth()->user()->active_organization)->first();

       // 3 Zasadnutia, 4 Nárhy
       $organization->menus()->attach([3,4]);

        // add permission user who created council
        auth()->user()->givePermissionTo('council delete');

    }
}
