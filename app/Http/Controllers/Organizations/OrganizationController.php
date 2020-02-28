<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use App\Organization;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index() {
        return view('organizations.index');
    }

    public function edit(Organization $organization, $slug) {
        return view('organizations.edit', compact('organization'));
    }










    public function store(User $user, $name, Request $request) {
        $user->organizations()->create($request->all());
        return back();
    }

    public function update(Organization $organization, $slug, Request $request) {
        $organization->update($request->all());
        return back();
    }
}
