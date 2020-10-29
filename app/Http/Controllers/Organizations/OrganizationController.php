<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Contact;
use App\Models\User;
use App\Models\Post;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index() {
        return view('organizations.home');
    }


    public function create() {
        return view('organizations.create', ['organization' => new Organization]);
    }


    public function store(User $user, $name, OrganizationFormRequest $request) {
        $user->organizations()->create($request->all());
        return redirect()->route('org.index', [ auth()->user()->active_organization, auth()->user()->slug]);
    }

    public function update(Organization $organization, $slug, OrganizationUpdateRequest $request) {
        $organization->update($request->all());
        return back();
    }

}
