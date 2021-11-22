<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function update(User $user, UserUpdateRequest $userRequest)
    {
        // dd($userRequest->all());
        $userRequest->save($user);

        $this->userRoles($user, $userRequest);
        $user->tags()->sync($userRequest->input('tag'));

        return new UserResource($user);
    }


     // For update and store User
     private function userRoles($user, $userRequest)
     {
        //  dd($userRequest->input('councils.*.id'));
         // Only admin giving roles and permissions
         if (!auth()->user()->hasAnyRole(['super-admin', 'admin'])) return;
 
         // For table user_council
         $user->councils()->sync($userRequest->input('councils.*.id'));
         $user->roles()->sync($userRequest->input('roles.*.id'));
         // $user->syncPermissions($userRequest->input('permission'));
     }

}
