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
    public function __construct()
    {
        $this->authorizeResource(Council::class, 'council');
    }

    public function index()
    {
        $councils = Council::whereOrganizationId(auth()->user()->active_organization)->orderBy('id', 'asc')->get();
        return view('council.index', compact('councils'));
    }

    public function show(Council $council){
        return $council;
    }

    public function edit(Council $council){
        return view('council.edit', compact('council') );
    }


    public function userList(Council $council, $slug)
    {
        return view('council.users', compact('council'))->with('users', $council->users()->get());
    }



    public function update(Request $request, Council $council) {
        $council->update($request->only(['name', 'description', 'quorate', 'min_user']));
        return $council;
    }

    public function destroy(Council $council) {
        if ($council->meetings->count()) {
            return response()->json(['message' => 'Zastupiteľstvo už obsahuje zasadnutia.'], 401);
        }
        $council->delete();
    }


}
