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
//      $meeting = Meeting::first();
//
//      $org = Organization::first()->users;
//     dd($org);
//
//       dd($meeting->council->organization);

//       Assing role for all users
//       $users = User::find(70);
//       dd( $users->hasPermissionTo('council edit') );

     dd( User::whereHas("permissions", function($q){ $q->where("name", "council create"); })->get() );

//    Neodskúšané
//       User::role('writer')->get()

////       foreach ($users as $user){
////          $user->organizations()->attach( $user->active_organization);
////       }
   }

   public function artisan(){
       \Artisan::call('optimize:clear');
       return 'Ok';
   }
}
