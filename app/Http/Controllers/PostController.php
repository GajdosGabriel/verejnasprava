<?php

namespace App\Http\Controllers;


use App\Post;
use App\Question;
use App\User;
use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\SavePostRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'update', 'storePost', 'deletePost']);
    }

    public function index() {

        $posts = Cache::rememberForever('posts', function()
        {
           return Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
                return Carbon::parse($item->date_in)->format('F-Y');
            });
        });

        return view('post.index')->with('posts', $posts);
    }


    public function create(User $user)
    {
       $user->posts()->orderBy('id', 'DESC')->take(3)->get();

        return view('post.create')->with('user', $user);
    }



    public function edit(User $user, Post $post)
    {
        $this->authorize('update', $post);

        return view('post.edit')->with('post', $post)
            ->with('user', $user);
    }

    public function copyPost(User $user, Post $post)
    {
        return view('post.copy')->with('post', $post)
            ->with('user', $user);
    }

    public function store(User $user, SavePostRequest $request)
    {
        $post = $user->posts()->create($request->all());
        $this->authorize('update', $post);
        Cache::forget('posts');

        $post->saveImage($request);
//        flash()->success('Doklad bol pridaný. ');
        return redirect()->route('create', [\Auth::user()->slug]);
    }


    public function update(SavePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update( $request->all() );
        Cache::forget('posts');
        $post->saveImage($request, $post);

        flash()->success('Doklad opravený! ');
        return \Redirect::route('create', ['slug' => \Auth::user()->slug ]);
    }


    public function destroyPost(Post $post)
    {
        $this->authorize('update', $post);
        Cache::forget('posts');

        $post->file->each(function($post){
            Storage::delete($post->filename);
       });

        $post->delete();
        flash()->success('Doklad bol zmazaný! ');
        return back();
    }






}
