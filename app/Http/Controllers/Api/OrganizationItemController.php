<?php

namespace App\Http\Controllers\Api;

use App\Models\Council\Item;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Notifications\Item\RequireItemvote;

class OrganizationItemController extends Controller
{
    public function show(Organization $organization, Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item) {
        $item->update($request->all());

        if ($request->has('notification')){
            foreach ($item->meetings as $meeting){
                foreach ($meeting->council->users as $user){
                $user->notify(new RequireItemvote($user, $item));
                }
            }
            return response($item)->header('notification', 'Žiadosť o hlasovanie bola odoslovaná.');
        }
        return new ItemResource($item);
    }
}
