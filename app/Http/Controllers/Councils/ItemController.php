<?php

namespace App\Http\Controllers\Councils;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Models\Council\Meeting;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Item::whereUserId(auth()->user()->id)->get();
        return view('council.items.index', compact('items'));
    }

    public function create() {
        return view('council.items.create');
    }

    public function show(Item $item) {
        return view('council.items.show', compact('item'))->with(['meeting' => $item->meeting]);
    }

    public function edit(Item $item) {
        return view('council.items.edit', compact('item'))->with(['meeting' => $item->meeting]);
    }

    public function update(Request $request, Item $item) {
        $item->update(array_merge($request->except('filename', 'fileDelete'), ['user_id' => auth()->user()->id]));
        $item->saveFile($request);
        return redirect()->route('item.show',[$item->id, $item->slug]);
    }

    public function store(Request $request, Meeting $meeting) {

        $item = $meeting->items()->create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

        $item->update(['order' => $meeting->items()->count() +1] );

        $item->saveFile($request);
        return redirect()->route('item.show',[$item->id, $item->slug]);
    }

    public function storeItem(Request $request) {

        $item = Item::create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

//        $item->update(['order' => $meeting->items()->count() +1] );

//        $item->saveFile($request);
        return redirect()->route('item.show',[$item->id, $item->slug]);
    }

    public function delete(Item $item) {
        $item->delete();
        return back();
    }


}
