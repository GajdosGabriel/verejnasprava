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

        $user = User::first();
       $organization = $user->whereHas('organizations', function ($query) use ($organization){
            $query->whereOrganizationId($organization->id);
        })->get();

//        $organization = $organization->whereHas('users')->get();
//        dd($organization);
        return view('organizations.workers.index', compact('organization'));
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

        $user->givePermissionTo('council view');
        $organization->users()->attach($user);

        return back();
    }

}
