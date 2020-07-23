<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function posts(){
        $posts =  Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
            return Carbon::parse($item->date_in)->format('F-Y');
        });

        return $posts;
    }
}
