<?php

namespace App\Http\Controllers;

use App\Filters\PostFilters;
use App\Models\Council\Meeting;
use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
   public function test()
   {
      $meeting = Meeting::first();

      $org = Organization::first()->users;
     dd($org);

       dd($meeting->council->organization);
//       $users = User::all();
//       foreach ($users as $user){
//           $user->givePermissionTo('posts', 'contacts', 'helps');
//       }
   }

   public function artisan(){
       \Artisan::call('optimize:clear');
       return 'Ok';
   }
}
