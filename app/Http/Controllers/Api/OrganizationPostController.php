<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Filters\PostFilters;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\SavePostRequest;

class OrganizationPostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index(Organization $organization, PostFilters $postFilters)
    {
        $posts = $organization->posts()->filter($postFilters)
           ->latest()->paginate(15);

        return PostResource::collection($posts);
    }

    public function store(Organization $organization, SavePostRequest $request)
    {
        $post = $organization->posts()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id] ));

        $post->saveFile($request);

        return redirect()->route('posts.create');
    }

    public function update(Organization $organization, Post $post, SavePostRequest $request)
    {
        $post->update($request->except('filename', 'fileDelete') );
        $post->saveFile($request);
//        $post->saveImage($request, $post);

//        flash()->success('Doklad opravený! ');
        return redirect()->route('posts.index');
    }


    public function destroy(Organization $organization, Post $post)
    {
        $post->delete();

        return $post;
    }
}
