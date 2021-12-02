<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Models\Council\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Item::class, 'item');
    }

    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            $items = Item::whereOrganizationId(auth()->user()->active_organization)->whereDoesntHave('meetings')->get();
        }else {
            $items = Item::whereUserId(auth()->user()->id)->whereDoesntHave('meetings')->get();
        };

        $meetings = Meeting::where('start_at', '>=', Carbon::now())->whereHas('council', function (Builder $query) {
            $query->whereOrganizationId(auth()->user()->active_organization);
        })->orderBy('start_at', 'desc')->get();

        return view('council.items.index', compact(['items', 'meetings']));
    }

    public function create()
    {
        return view('council.items.create');
    }

    public function show(Item $item)
    {
        return view('council.items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('council.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $item->update(array_merge($request->except('filename', 'fileDelete'), ['user_id' => auth()->user()->id]));
        $item->saveFile($request);
        session()->flash('flash', 'Návrh bol aktualizovaný.');
        return redirect()->route('items.show', $item->id);
    }

    public function store(Request $request)
    {
        $item = Item::create(array_merge($request->except('filename'), [
            'user_id' => auth()->user()->id,
            'organization_id' => auth()->user()->active_organization,
        ]));

//        $item->update(['order' => $meeting->items()->count() +1] );
//
        $item->saveFile($request);
        return redirect()->route('items.show', $item->id);
    }



    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }
}
