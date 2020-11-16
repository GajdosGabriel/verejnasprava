<?php

namespace App\Http\Controllers;

use App\Models\Council\Council;
use App\Models\File;
use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class TestController extends Controller
{
   public function test()
   {
       $files = File::all();

       foreach ($files as $file){
          $post = Post::withTrashed()->find($file->fileable_id);

          $file->update(['user_id' => $post->organization_id]);

       }
       dd('OK');


// Retrieve posts with at least one comment containing words like foo%...
//       $users = User::whereHas('organizations', function (Builder $query) {
//           $query->where('id', '=', 1);
//       })->get();
//
//       dd($users);
//      $users = Role::with('users')->where('name', 'super-admin')->get();

//      dd($admin);
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


}
