<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTagRequest;
use App\Http\Resources\TaskResource;

class OrganizationTagController extends Controller
{
    public function index(Organization $organization)
    {
        return TaskResource::collection($organization->tags);
    }

    public function store(Organization $organization, SaveTagRequest $saveTagRequest)
    {
      $tag =  $organization->tags()->create([
            'name' => $saveTagRequest->input('name')
        ]);

        return $tag;
    }

    public function destroy(Organization $organization, Tag $tag)
    {
      $tag->delete();
    }
}
