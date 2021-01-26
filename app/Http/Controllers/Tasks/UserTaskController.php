<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function index(User $user){
        return $user->tasks;
    }

    public function update(User $user, Task $task, Request $request ){
//        dd($request->all());
       $task = $task->update($request->all());
        return $task;
    }
}
