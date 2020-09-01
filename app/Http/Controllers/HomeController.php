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
        if (auth()->user()) {

            if (auth()->user()->active_organization == null) {

                // Verificed auth user
                return redirect()->route('org.create', [auth()->user()->id, auth()->user()->slug]);
            }
            return redirect()->route('org.index', [auth()->user()->active_organization, auth()->user()->slug]);
        }

        return view('public.index');
    }

    public function publishedPosts(Organization $organization, $slug)
    {
        $posts = $organization->posts()->orderBy('date_in', 'desc')->get()->groupBy(function ($item) {
            return Carbon::parse($item->date_in)->format('F-Y');
        });
        return view('public.publishedPosts', compact('posts', 'organization'));
    }

    public function redirect()
    {
        if (auth()->user()) {
            if (auth()->user()->active_organization != null)
                return redirect()->route('org.index', [auth()->user()->active_organization, auth()->user()->slug]);
        }

        //        Po registrácií presmeruje na create org formulár
        return redirect()->route('org.create', [auth()->user()->id, auth()->user()->slug]);

    }

    public function contact()
    {

        return view('public.contact');
    }

    public function zverejnovanie()
    {

        return view('public.zverejnovanie');
    }

    public function gdpr(){
        return view('public.ochrana-osobnych-udajov');
    }


}
