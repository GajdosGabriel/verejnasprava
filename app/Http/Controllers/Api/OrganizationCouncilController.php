<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouncilCreateRequest;
use App\Http\Resources\OrganizationResource;

class OrganizationCouncilController extends Controller
{
    public function store( Organization $organization, CouncilCreateRequest $request) {
        $organization->councils()->create(array_merge($request->all()));
        return new OrganizationResource($organization);
    }
}
