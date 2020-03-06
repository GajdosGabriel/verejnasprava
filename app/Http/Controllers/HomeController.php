<?php

namespace App\Http\Controllers;

use App\Organization;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Question;

class HomeController extends Controller
{

    public function index()
    {
        if(auth()->user()) {
            if(auth()->user()->active_organization)
           return redirect()->route('org.index', [auth()->user()->active_organization, auth()->user()->slug ]);
        }
        return view('public.index');
    }

    public function publishedPosts(Organization $organization, $slug) {
        $posts =  $organization->posts()->orderBy('date_in', 'desc')->get()->groupBy(function($item){
            return Carbon::parse($item->date_in)->format('F-Y');
        });
        return view('public.publishedPosts', compact('posts', 'organization'));
    }

    public function redirect() {
        return redirect()->route('user.index', [auth()->user()->id, auth()->user()->slug]);
    }

    public function contact() {

        return view('public.contact');
    }


}
