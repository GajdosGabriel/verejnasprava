<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Filters\PostFilters;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class OrganizationPostController extends Controller
{
    public function index(Organization $organization, PostFilters $postFilters)
    {
        $posts = $organization->posts()->filter($postFilters)
           ->latest()->paginate();

        return PostResource::collection($posts);
    }

    public function destroy(Organization $organization, Post $post)
    {
        $post->delete();
    }
}
