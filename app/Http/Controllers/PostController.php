<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\SavePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'copy']);
    }

    public function index()
    {
//        $posts = Post::whereOrganizationId(auth()->user()->active_organization)->paginate(20);
        return view('post.index');
    }


//    public function index() {
//
//        $posts = Cache::rememberForever('posts', function()
//        {
//           return Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
//                return Carbon::parse($item->date_in)->format('F-Y');
//            });
//        });
//
//        return view('post.index')->with('posts', $posts);
//    }



    public function create()
    {
//        $this->authorize('update', $organization);
        return view('post.create')->with('post', new Post);
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function copy(Post $post)
    {
        $this->authorize('update', $post);

        return view('post.create', compact('post'));
    }

}
