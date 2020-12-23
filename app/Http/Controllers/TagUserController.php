<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TagUserController extends Controller
{
    public function index($id)
    {
        $users = User::whereHas('tags',  function (Builder $query) use ($id){
            $query->whereId($id);
        })->get();

        return $users;
    }
}
