<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function destroy(Comment $comment){
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }
}
