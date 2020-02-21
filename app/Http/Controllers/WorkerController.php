<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Worker;
use Illuminate\Support\Str;

class WorkerController extends Controller
{

    public function index(User $user) {
        return view('worker.index')->with('user', $user);
    }

    public function store(Request $request) {
//        dd($request->all());

        Worker::create([
            'user_id' => \Auth::user()->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'psc' => $request->input('psc'),
            'position' => $request->input('position'),
            'date_born' => $request->input('date_born'),
            'date_contract' => $request->input('date_contract'),
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'slug' => Str::slug($request->input('first_name')) . '-' . $request->input('last_name', '-'),
        ]);
        return back();
    }

    public function destroy(Worker $worker) {
        $worker->delete();
        return back();
    }
}
