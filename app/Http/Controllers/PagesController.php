<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index() {

        $posts = Post::orderBy('id', 'DESC')->get();

        return view('post.index')->with('posts', $posts);
    }
}
