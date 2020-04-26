<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Organization;
use App\Models\User;
use App\Notifications\User\InviteUser;
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
        $users = User::whereActive_organization(auth()->user()->active_organization)->latest()->get();

        return view('user.index', compact(['users', 'organization']));
    }


    public function create(Organization $organization, $slug) {
        $user= new User();
        return view('user.create', compact('organization', 'user'));
    }

    public function edit(User $user, $slug) {
//        dd($user);
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $userRequest) {
        $userRequest->save($user);

        $this->userRoles($user, $userRequest);

        return redirect()->route('user.index', [$user->active_organization, 'slug']);
    }


    public function newOrganization() {
        return view('user.org-create', ['organization' => new Organization]);
    }

    public function store(Organization $organization, UserCreateRequest $userRequest) {

//        dd($userCreateRequest->all());
        $user = User::create([
            'first_name' => $userRequest['first_name'],
            'last_name' => $userRequest['last_name'],
            'email' => $userRequest['email'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);

        $this->userRoles($user, $userRequest);

        return redirect()->route('user.index', [$user->active_organization, 'slug']);
    }

    // For update ane store User
    private function userRoles($user, $userRequest) {
        $user->councils()->sync($userRequest->input('council'));
        $user->roles()->sync($userRequest->input('role'));
    }

    public function delete(User $user) {
        $user->delete();
        return back();
    }

    public function sendInvitation(User $user) {
        $user->notify(new InviteUser($user));
        return back();
    }





}
