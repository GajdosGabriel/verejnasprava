<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Notifications\Task\NewTask;
use Illuminate\Http\Request;

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
