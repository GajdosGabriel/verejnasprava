<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Question;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    public function redirect() {

        return redirect()->route('user.index', [auth()->user()->id, auth()->user()->slug]);
    }

    public function contact() {

        return view('home.contact');
    }


}
