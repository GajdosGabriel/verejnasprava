<?php

namespace App\Http\Controllers\Councils;


use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Council\Council;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

class CouncilController extends Controller
{
    public function index(Organization $organization){
        return view('council.index', compact('organization'));
    }

    public function create(Organization $organization){
        $council = new Council();
        return view('council.create', compact('organization','council') );
    }

    public function edit(Council $council){
        return view('council.edit', compact('council') );
    }

    public function update(Request $request, Council $council) {
        $council->update(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return redirect()->route('zast.index', [$council->organization_id, $council->slug]);
    }


    public function store(Request $request, Organization $organization) {
        $organization->councils()->create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return redirect()->route('zast.index', [$organization->id, $organization->slug]);
    }


    public function createUser(Council $council, $slug) {
        return view('council.createUser', compact('council'));
    }

    public function userList(Council $council, $slug) {
        return view('council.users', compact('council'))->with('users', $council->users()->get());
    }

    public function storeUser(Council $council, UserUpdateRequest $userUpdateRequest) {
        $council->users()->create([
            'first_name' => $userUpdateRequest['first_name'],
            'last_name' => $userUpdateRequest['last_name'],
            'email' => $userUpdateRequest['email'],
            'password' => Hash::make('randompassword'),
            'active_organization' => auth()->user()->active_organization
        ]);
        return redirect()->route('zast.userList',[$council->id, $council->slug]);
    }
}
