<?php

namespace App\Http\Controllers\Organizations;

use App\User;
use App\Organization;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(Organization $organization, $slug) {
        return view('organizations.index');
    }

    public function edit(Organization $organization, $slug) {
        return view('organizations.edit', compact('organization'));
    }

    public function store(User $user, $name, OrganizationFormRequest $request) {
        $user->organizations()->create($request->all());
        return back();
    }

    public function update(Organization $organization, $slug, OrganizationFormRequest $request) {
        $organization->update($request->all());
        return back();
    }
}
