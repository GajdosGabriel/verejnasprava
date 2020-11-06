<?php

namespace App\Http\Controllers;

use App\Models\Council\Council;
use App\Models\Organization;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
   public function test()
   {

      $users = Role::with('users')->where('name', 'super-admin')->get();

      dd($admin);
//       $orgs = Organization::first(1);
//       dd($orgs->menus);



//       foreach($orgs as $org){
//           $org->menus()->attach([1,2,7]);
////           print_r(isset($org->name));
//       }

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
