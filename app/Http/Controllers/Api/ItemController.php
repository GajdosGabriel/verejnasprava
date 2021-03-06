<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Council\Item;
use App\Notifications\Item\RequireItemvote;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $item;
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
        return response($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
