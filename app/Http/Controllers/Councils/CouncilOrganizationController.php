<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Council;
use App\Models\Organization;
use Illuminate\Http\Request;

class CouncilOrganizationController extends Controller
{
    public function index(Organization $organization)
    {
        return $organization->councils;
    }

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
