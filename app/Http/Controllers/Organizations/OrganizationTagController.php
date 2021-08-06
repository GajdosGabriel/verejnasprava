<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationTagController extends Controller
{
    public function index(Organization $organization)
    {
        return view('tag.index', ['tags' => $organization->tags]);
    }
}
