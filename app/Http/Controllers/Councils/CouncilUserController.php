<?php

namespace App\Http\Controllers\Councils;

use Illuminate\Http\Request;
use App\Models\Council\Council;
use App\Http\Controllers\Controller;


class CouncilUserController extends Controller
{
    public function index(Council $council)
    {
        $this->authorize('viewAny', Council::class);

        $users = $council->users()->get();

        return view('user.index', compact('users', 'council'));
    }
}
