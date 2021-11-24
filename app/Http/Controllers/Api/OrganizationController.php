<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Http\Requests\OrganizationUpdateRequest;

class OrganizationController extends Controller
{
    public function show(Organization $organization)
    {
        return new OrganizationResource($organization);
    }

    public function update(Organization $organization, OrganizationUpdateRequest $request) {
        $organization->update($request->all());
        return new OrganizationResource($organization);
    }


}
