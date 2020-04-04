<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
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
        $user= new User();
        return view('user.create', compact('organization', 'user'));
    }

    public function edit(User $user, $slug) {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $userUpdateRequest) {
        $userUpdateRequest->save($user);

        if ($userUpdateRequest->input('counsil'))
            $user->councils()->attach($userUpdateRequest->input('counsil'));

        return back();
    }


    public function newOrganization() {
        return view('user.org-create', ['organization' => new Organization]);
    }

    public function store(Organization $organization, UserCreateRequest $userCreateRequest) {

//        dd($userCreateRequest->all());
        $user = User::create([
            'first_name' => $userCreateRequest['first_name'],
            'last_name' => $userCreateRequest['last_name'],
            'email' => $userCreateRequest['email'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);

        auth()->user()->assignRole($userCreateRequest->input('role'));

        if($userCreateRequest->input('council'))
            $user->councils()->attach($userCreateRequest->input('council'));

        return back();
    }

    public function delete(User $user) {
        $user->delete();
        return back();
    }





}
