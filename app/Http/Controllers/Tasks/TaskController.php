<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return view('tasks.index');
    }

    public function update(Task $xxx, Request $request){

        //  MultiTasks from tasks/component
        foreach ($request->all() as $task){
           $t = Task::whereId($task['id'])->first();
            $t->update($task);
        }

    }
}
