<?php

namespace App\Http\Controllers\Posts;

use App\Filters\PostFilters;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function index($userId, PostFilters $postFilters )
    {
        return Post::whereOrganizationId($userId)
            ->filter($postFilters)
           ->latest()->paginate();
    }


}
