<?php

namespace App\Http\Controllers\Posts;


use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
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

    public function index() {
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



    public function create() {
//        $this->authorize('update', $organization);
        return view('post.create')->with('post', new Post);
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function copy(Post $post)
    {
        $this->authorize('update', $post);

        return view('post.create', compact('post'));
    }


    public function copyPost(User $user, Post $post)
    {
        return view('post.copy')->with('post', $post)
            ->with('user', $user);
    }

    public function store(SavePostRequest $request)
    {
        $organization = Organization::whereId(auth()->user()->active_organization)->first();
        $this->authorize('update', $organization);
        $post = $organization->posts()->create($request->except('filename'));

        $post->saveFile($request);

        return back();
    }


    public function update(Post $post, SavePostRequest $request)
    {
        $this->authorize('update', $post);
        $post->update($request->except('filename') );
//        Cache::forget('posts');
        $post->saveImage($request, $post);

//        flash()->success('Doklad opravený! ');
        return redirect()->route('posts.index');
    }


    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
//        Cache::forget('posts');

//        $post->file->each(function($post){
//            Storage::delete($post->filename);
//       });

        $post->delete();
//        flash()->success('Doklad bol zmazaný! ');
//        return redirect('posts.index');
    }






}
