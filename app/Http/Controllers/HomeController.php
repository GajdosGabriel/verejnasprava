<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Filters\PostFilters;
use App\Http\Requests\ContactUsRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Resources\PostfrontedResource;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactUs;

class HomeController extends Controller
{

    public function index()
    {
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
                return redirect()->route('organizations.index');
        }

        //        Po registrácií presmeruje na create org formulár
        return redirect()->route('organizations.create', [auth()->user()->id, auth()->user()->slug]);

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

    public function frontPosts(PostFilters $postFilters) {
//        $posts =  Post::orderBy('date_in', 'desc')->paginate()->groupBy(function($item){
//            return Carbon::parse($item->date_in)->format('F-Y');
//        });

//        $posts = Post::select(\DB::raw('max(id) as id'))
//            ->groupBy('organization_id')
//            ->paginate(20)
//        ;

        $posts = Post::filter($postFilters)
            ->latest()->paginate(20);
//        dd($posts);
        return PostfrontedResource::collection($posts);
    }

    public function store(ContactUsRequest $request)
    {

        // $validated = $request->validate([
        //     'email' => 'required|email',
        //     'body' => 'required',
        // ]);

        $users = User::whereHas('roles', function ($q) {
            $q->whereName('super-admin');
        })->get();


        foreach ($users as $user) {
            Notification::send($user, new ContactUs($request));
        }

        session()->flash('flash', 'Správa bola odoslaná.');

        return redirect()->back();
    }


}
