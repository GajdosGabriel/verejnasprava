<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
   public function test()
   {

//       $meeting = Meeting::first();
//       dd($meeting->items()
//           ->orderBy('created_at', 'asc')
//           ->get());

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
