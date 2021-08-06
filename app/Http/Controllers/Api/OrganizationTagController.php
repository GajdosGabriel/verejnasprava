<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationTagController extends Controller
{
    public function index(Organization $organization)
    {
       return $organization->tags;
    }
}
