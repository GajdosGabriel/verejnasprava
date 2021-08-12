<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class OrganizationUserController extends Controller
{
    public function index(Organization $organization)
    {
        return UserResource::collection($organization->users);
    }

    public function show(Organization $organization, User $user)
    {
        return new UserResource($user);
    }
}
