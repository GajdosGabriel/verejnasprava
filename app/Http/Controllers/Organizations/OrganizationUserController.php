<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationUserController extends Controller
{
    public function index(Organization $organization)
    {
        return $organization->users;
    }

}
