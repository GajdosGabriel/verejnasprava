<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function store(Task $task, Request $request)
    {
        $task->comments()->create($request->all());
    }
}
