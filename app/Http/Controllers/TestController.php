<?php

namespace App\Http\Controllers;

use App\Filters\PostFilters;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function test($id, PostFilters $postFilters)
   {
       $posts = Post::whereOrganizationId($id)
           ->filter($postFilters)
           ->get();
//           ->latest()->paginate();
       return $posts;
   }
}
