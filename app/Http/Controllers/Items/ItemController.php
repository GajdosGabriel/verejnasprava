<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Models\Council\Meeting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Item::whereUserId(auth()->user()->id)->get();

        $meetings = Meeting::whereHas('council', function (Builder $query) {
            $query->whereOrganizationId(auth()->user()->id);
        })->get();
        return view('council.items.index', compact(['items', 'meetings']));
    }

    public function create() {
        return view('council.items.create');
    }

    public function show(Item $item) {
        return view('council.items.show', compact('item'));
    }

    public function edit(Item $item) {
        return view('council.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item) {
        $item->update(array_merge($request->except('filename', 'fileDelete'), ['user_id' => auth()->user()->id]));
        $item->saveFile($request);
        return redirect()->route('items.show',$item->id);
    }

    public function store(Request $request) {

        $item = Item::create(array_merge($request->except('filename'), ['user_id' => auth()->user()->id]));

//        $item->update(['order' => $meeting->items()->count() +1] );
//
        $item->saveFile($request);
        return redirect()->route('items.show', $item->id);
    }



    public function destroy(Item $item) {
        $item->delete();
    }


}
