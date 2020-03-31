<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home(User $user){

        return view('user.home', compact(['user']));

    }

    public function index(Organization $organization, $slug) {
        $users = User::whereActive_organization(auth()->user()->active_organization)->get();

        return view('user.index', compact(['users', 'organization']));
    }


    public function create(Organization $organization, $slug) {
        return view('user.create', compact('organization'));
    }


    public function newOrganization() {
        return view('user.org-create', ['organization' => new Organization]);
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

        auth()->user()->assignRole($userUpdateRequest->input('role'));
//        $user->givePermissionTo( $userUpdateRequest->input('role') );

        return back();
    }





}
