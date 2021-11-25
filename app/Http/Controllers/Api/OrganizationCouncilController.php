<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Council\Council;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouncilCreateRequest;
use App\Http\Resources\OrganizationResource;

class OrganizationCouncilController extends Controller
{
    public function update( Organization $organization, Council $council, CouncilCreateRequest $request) {
        $council->update($request->only(['name', 'description', 'quorate', 'min_user']));
        return $council;
    }

    public function store( Organization $organization, CouncilCreateRequest $request) {
        $organization->councils()->create(array_merge($request->all()));
        return new OrganizationResource($organization);
    }

    public function destroy(Organization $organization, Council $council) {
        if ($council->meetings->count()) {
            return response()->json(['message' => 'Zastupiteľstvo už obsahuje zasadnutia.'], 401);
        }
        $council->delete();
    }
}
