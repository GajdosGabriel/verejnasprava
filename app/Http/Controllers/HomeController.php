<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Question;

class HomeController extends Controller
{

    public function index()
    {
        if(auth()->user()) {
            if(auth()->user()->active_organization)
            // Verificed auth user
//           auth()->user()->update(['email_verified_at' => \Carbon\Carbon::now()]);
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
        if(auth()->user()) {
            if(auth()->user()->active_organization != null)
                return redirect()->route('org.index', [auth()->user()->active_organization, auth()->user()->slug ]);
        }

        //        Po registrácií presmeruje na org. formulár
        return redirect()->route('user.new-organization', [ auth()->user()->id, auth()->user()->slug]);

        // Stará verzia
        //        return view('user.index');
//        return redirect()->route('user.index', [auth()->user()->id, auth()->user()->slug]);
    }

    public function contact() {

        return view('public.contact');
    }

    public function zverejnovanie() {

        return view('public.zverejnovanie');
    }


}
