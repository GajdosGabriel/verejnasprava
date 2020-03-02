<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Http\Requests;
use App\Http\Requests\UserUpdateRequest;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(){
        return view('user.index');
    }

    public function newOrganization() {
        return view('user.create', ['organization' => new Organization]);
    }


    public function userProfil(User $user)
    {
        $activities = $user->activity()->latest()->with('subject')->paginate(20);
        return view('user.edit')->with('user', $user)->with('activities', $activities);
    }

    public function show(User $user, Category $category)
    {
        $posts = $user->posts();

        if($category->exists) {
           $posts = $posts->whereCategoryId($category->id);
        }

        $posts = $posts->orderBy('date_in', 'desc')->get()
            ->groupBy(function($item){
                return Carbon::parse($item->date_in)->format('F-Y');
            });

        return view('post.index')->with('posts', $posts)
            ->with('user', $user);
    }



    public function updateUser(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        flash()->success('Profil Úspešné aktualizovaný');
        return redirect( route('user.profil', $user->slug));
    }








}
