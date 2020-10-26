<?php

namespace App\Http\Controllers;

use App\Models\Council\Council;

class TestController extends Controller
{
   public function test()
   {

       $council = Council::find(1);
//       dd($council->users);

       foreach ($council->users as $user){
           print_r($user->first_name);
//           $user->notify(new RequireItemvote($user, '$item'));
       }

//       $users = Meeting::whereHas('council', function (Builder $query) {
//           $query->whereOrganizationId(1);
//       })->get();
//
//       dd($users);





//      $meeting = Meeting::find(2);
//
//     dd($meeting->usersOfCouncil());
//     dd($meeting->council->users->count());
//
//      $org = Organization::first()->users;
//     dd($org);
//
//       dd($meeting->council->organization);

//       Assing role for all users
//       $users = User::find(70);
//       dd( $users->hasPermissionTo('council edit') );

//     dd( User::whereHas("permissions", function($q){ $q->where("name", "council create"); })->get() );

//    Neodskúšané
//      $users = User::all();
//
//       foreach ($users as $user){
//           $user->assignRole('admin');
//       }

//       foreach ($users as $user){
//          $user->organizations()->attach( $user->active_organization);
//       }
   }

   public function artisan(){
       \Artisan::call('optimize:clear');
       return 'Ok';
   }
}
