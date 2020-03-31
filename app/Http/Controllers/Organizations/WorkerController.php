<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{

    public function index(Organization $organization, $slug) {
        $users = User::whereActive_organization(auth()->user()->active_organization)->get();

        return view('organizations.workers.index', compact(['users', 'organization']));
    }

    public function create(Organization $organization, $slug) {
        return view('organizations.workers.create', compact('organization'));
    }

    public function store(Organization $organization, UserUpdateRequest $userUpdateRequest) {

//        dd($userUpdateRequest->all());
        $user = User::create([
            'first_name' => $userUpdateRequest['first_name'],
            'last_name' => $userUpdateRequest['last_name'],
            'email' => $userUpdateRequest['email'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);

        $user->givePermissionTo( $userUpdateRequest->input('role') );

        return back();
    }

}
