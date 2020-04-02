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


    // Zastupiteľstva v ktorých je členom
    public function userCouncils(User $organization){
        return view('council.index', compact('organization'));
    }




    public function index(Organization $organization, $slug) {
        $users = User::whereActive_organization(auth()->user()->active_organization)->get();

        return view('user.index', compact(['users', 'organization']));
    }


    public function create(Organization $organization, $slug) {
//        dd($organization);
        return view('user.create', compact('organization'));
    }

    public function edit(User $user, $slug) {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $userUpdateRequest) {

        $user->update([
            'first_name' => $userUpdateRequest['first_name'],
            'last_name' => $userUpdateRequest['last_name'],
            'email' => $userUpdateRequest['email'],
        ]);
        return back();
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

//        if($userUpdateRequest->input('council')) {
//            $user->councils()->create($userUpdateRequest->input('council'));
//        }

        return back();
    }





}
