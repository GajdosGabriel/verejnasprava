<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Task\NewTask;
use App\Http\Controllers\Controller;

class UserTaskController extends Controller
{
    public function index(User $user){
        return Task::whereRequestedId($user->id)->latest()->get();
    }

    public function update(User $user, Task $task, Request $request )
    {
       $task = $task->update($request->all());
        return $task;
    }

    public function store(User $user, Request $request){
      $task =  $user->tasks()->create($request->all());
      $task->user->notify(new NewTask($user, $task));
    }
}
