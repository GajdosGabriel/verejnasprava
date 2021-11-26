<?php

namespace App\Http\Controllers\Organizations;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Council\Council;
use App\Http\Controllers\Controller;

class OrganizationCouncilController extends Controller
{

    

    public function create(Organization $organization)
    {
        $council = new Council();
        return view('council.create', compact(['organization', 'council']));
    }

    public function store(Request $request, Organization $organization) {
        $organization->councils()->create(array_merge($request->all()));
        return redirect()->route('council.index');
    }
}
