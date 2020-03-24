<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function create(Meeting $meeting) {
        return view('council.items.create', compact('meeting'));
    }

    public function store(Request $request, Meeting $meeting) {
        $item = $meeting->items()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

        $item->saveImage($request);
        return back();
    }
}
