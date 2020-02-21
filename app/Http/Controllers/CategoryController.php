<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function category(Category $category) {

      $posts =  $category->posts()->orderBy('date_in', 'desc')->get()->groupBy(function($item){
            return Carbon::parse($item->date_in)->format('F-Y');
        });

        return view('post.index')->with('posts', $posts);
    }


}
