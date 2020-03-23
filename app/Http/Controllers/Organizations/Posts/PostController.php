<?php

namespace App\Http\Controllers\Organizations\Posts;


use App\Organization;
use App\Post;
use App\User;
use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\SavePostRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'update', 'storePost', 'deletePost']);
    }

    public function index(Organization $organization, $slug) {
        $this->authorize('update', $organization);
        $posts = $organization->posts;
        return view('post.index', compact('posts'));
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



    public function create(Organization $organization, $slug) {
        $this->authorize('update', $organization);
        return view('post.create', compact('organization'))->with('post', new Post);
    }


    public function edit(Post $post, $slug)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function copy(Post $post, $slug)
    {
        $this->authorize('update', $post);

        return view('post.create', compact('post'));
    }


    public function copyPost(User $user, Post $post)
    {
        return view('post.copy')->with('post', $post)
            ->with('user', $user);
    }

    public function store(Organization $organization, SavePostRequest $request)
    {
        $this->authorize('update', $organization);
        $post = $organization->posts()->create($request->except('filename'));
//        Cache::forget('posts');

        $post->saveImage($request);
//        flash()->success('Doklad bol pridaný. ');
        return back();
    }


    public function update(Post $post, SavePostRequest $request)
    {
        $this->authorize('update', $post);
        $post->update($request->except('filename') );
//        Cache::forget('posts');
        $post->saveImage($request, $post);

//        flash()->success('Doklad opravený! ');
        return redirect()->route('org.post.index', [ $post->organization->id, $post->organization->slug ]);
    }


    public function delete(Post $organization)
    {
        $this->authorize('update', $organization);
//        Cache::forget('posts');

//        $post->file->each(function($post){
//            Storage::delete($post->filename);
//       });

        $organization->delete();
//        flash()->success('Doklad bol zmazaný! ');
        return back();
    }






}
