<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Contact;
use App\Models\User;
use App\Models\Post;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{


    public function index() {
        return view('organizations.home');
    }


    public function create() {
        return view('organizations.create', ['organization' => new Organization]);
    }


    public function store( OrganizationFormRequest $request) {
        auth()->user()->organizations()->create($request->all());
        return redirect()->route('organizations.index');
    }


}
