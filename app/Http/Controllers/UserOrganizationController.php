<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationFormRequest;

class UserOrganizationController extends Controller
{
    public function create(User $user) {
        return view('organizations.create', ['organization' => new Organization]);
    }

    public function store( User $user, OrganizationFormRequest $request) {
        $user->organizations()->create($request->all());
        return redirect()->route('organizations.index');
    }

}
