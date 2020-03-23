<?php

namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Requests\UserUpdateRequest;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){
        if(auth()->user()) {
            if(auth()->user()->active_organization != null)
                return redirect()->route('org.index', [auth()->user()->active_organization, auth()->user()->slug ]);
        }
        return view('user.index');
    }

    public function newOrganization() {
        return view('user.create', ['organization' => new Organization]);
    }

    public function store(UserUpdateRequest $userUpdateRequest) {

        User::create([
            'first_name' => $userUpdateRequest['first_name'],
            'last_name' => $userUpdateRequest['last_name'],
            'email' => $userUpdateRequest['email'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);

        return back();
    }



}
