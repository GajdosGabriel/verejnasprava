<?php

namespace App\Http\Controllers;

use App\Filters\PostFilters;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function test()
   {
//       $users = User::all();
//       foreach ($users as $user){
//           $user->givePermissionTo('posts', 'contacts', 'helps');
//       }
   }
}
