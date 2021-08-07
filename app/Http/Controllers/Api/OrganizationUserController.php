<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class OrganizationUserController extends Controller
{
    public function show(Organization $organization, User $user)
    {
        return new UserResource($user);
    }
}
