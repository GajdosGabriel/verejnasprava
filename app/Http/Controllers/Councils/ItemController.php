<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Meeting $meeting){
        $items = $meeting->items()->published()->get();
        return view('council.items.index', compact(['items', 'meeting']) );
    }

    public function create(Meeting $meeting) {
        return view('council.items.create', compact('meeting'));
    }

    public function show(Item $item) {
        return view('council.items.show', compact('item'))->with(['meeting' => $item->meeting])->with(['interpellations' => $item->interpellations()->whereStatus(1)->get()]);
    }

    public function edit(Item $item) {
        return view('council.items.edit', compact('item'))->with(['meeting' => $item->meeting]);
    }

    public function update(Request $request, Item $item) {
        $item->update(array_merge($request->except('filename', 'fileDelete'), ['user_id' => auth()->user()->id]));
        $item->saveFile($request);
        return redirect()->route('item.index',[$item->meeting->id, $item->meeting->slug]);
    }

    public function store(Request $request, Meeting $meeting) {
        $item = $meeting->items()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

        $item->update(['order' => $meeting->items()->count() +1] );

        $item->saveFile($request);
        return redirect()->route('item.index',[$meeting->id, $meeting->slug]);
    }

    public function delete(Item $item) {
        $item->delete();
        return back();
    }

    public function published(Item $item) {
        $item->published();
        return back();
    }

}
