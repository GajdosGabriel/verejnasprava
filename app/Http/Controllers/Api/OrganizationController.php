<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    public function show(Organization $organization){
        // $menu = Menu::horizontalMenu()->get();
        // $organization = Organization::find($id);

        // return response([ $menu, $organization]);

        return new OrganizationResource($organization);
    }

}
