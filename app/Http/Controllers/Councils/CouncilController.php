<?php

namespace App\Http\Controllers\Councils;


use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Council\Council;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

class CouncilController extends Controller
{
    public function index()
    {
        $organization = Organization::whereId(auth()->user()->active_organization)->first();
        $councils = $organization->councils()->orderBy('id', 'asc')->get();
        return view('council.index', compact('councils'));
    }

    public function store(Request $request, Organization $organization) {
        $organization->councils()->create(array_merge($request->all()));
        return redirect()->route('council.index');
    }


    public function userList(Council $council, $slug)
    {
        return view('council.users', compact('council'))->with('users', $council->users()->get());
    }


}
