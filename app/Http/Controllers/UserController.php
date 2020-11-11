<?php

namespace App\Http\Controllers;



use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Council\Council;
use App\Models\Organization;
use App\Models\User;
use App\Notifications\User\InviteUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home(User $user){

        if (auth()->user()->active_organization == null) {

            // Verificed auth user
            return redirect()->route('organizations.create');
        }

        return view('user.home', compact(['user']));

    }

    public function index() {
        $users =  Organization::whereId(auth()->user()->active_organization)->first()->users;;
        return view('user.index', compact('users'));
    }


    public function create() {
        $user = new User();
        return view('user.create', compact('user'));
    }

    public function edit(User $user) {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UserUpdateRequest $userRequest) {

        $userRequest->save($user);

        $this->userRoles($user, $userRequest);

        return redirect()->route('users.index');
    }

    public function store(Organization $organization, UserCreateRequest $userRequest) {

        $user = User::create([
            'first_name' => $userRequest['first_name'],
            'last_name' => $userRequest['last_name'],
            'email' => $userRequest['email'],
            'employment' => $userRequest['employment'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);

        $user->organizations()->attach(auth()->user()->active_organization);
        $this->userRoles($user, $userRequest);
        $this->sendInvitation($user);

        return redirect()->route('users.index');
    }

    // For update and store User
    private function userRoles($user, $userRequest) {

        // Only admin giving roles and permissions
        if (! auth()->user()->hasAnyRole(['super-admin','admin'])) return;

        // For table user_council
        $user->councils()->sync($userRequest->input('council'));
        $user->roles()->sync($userRequest->input('role'));
        $user->syncPermissions($userRequest->input('permission'));
    }

    public function destroy(User $user) {
        $user->delete();
        return back();
    }

    public function sendInvitation(User $user) {
        $user->notify(new InviteUser($user));
        $user->update(['send_invitation' => now()]);
        return back();
    }

    public function setup() {
        $organization = auth()->user()->organization;
        $user = auth()->user();
        $council = new Council();
        return view('user.setup', compact(['organization', 'user', 'council']));
    }





}
