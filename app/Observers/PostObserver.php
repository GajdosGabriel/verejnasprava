<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        $post->contact->increment('contact_used');

        \Session::put('dateInLastPost', $post->date_in);
    }
}
