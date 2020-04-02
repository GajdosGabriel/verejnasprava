<?php

namespace App\Http\Controllers\Organizations;

use App\Models\User;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(Organization $organization, $slug) {
//            dd( auth()->user()->councils );

        return view('organizations.home');
    }

    public function edit(Organization $organization, $slug) {
        return view('organizations.edit', compact('organization'));
    }


    public function store(User $user, $name, OrganizationFormRequest $request) {
        $user->organizations()->create($request->all());
        return redirect()->route('org.index', [ auth()->user()->active_organization, auth()->user()->slug]);
    }

    public function update(Organization $organization, $slug, OrganizationFormRequest $request) {
        $organization->update($request->all());
        return back();
    }
}
