<?php

namespace App\Http\Controllers;


use App\Models\Question;
use App\Models\User;
use App\Notifications\Questions;
use Illuminate\Support\Facades\Validator;
use App\Models\Support;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SupportController extends Controller
{
    public function index() {

//        $questions = Support::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $questions = Support::orderBy('created_at', 'desc')->paginate(10);

        return view('support.index')->with('questions', $questions);

    }

    public function update(Support $support, Request $request){
        $support->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);

        // Answer for question
        if ($support->user_id != auth()->user()->id) // not yourself notification
        $support->user->notify(new Questions($support));

        return back();
    }

    public function store(Request $request) {

     $question = auth()->user()->supports()->create($request->all());

//        flash()->success('Správa bola odoslaná');

        // New question
        $users = User::whereHas('roles', function ($q){
            $q->whereName('super-admin');
        })->get();

        foreach($users as $user){
            $user->notify(new Questions($question));
        }

        return redirect()->back();
    }

    public function destroy(Support $support){
        $this->authorize('delete', $support);

        $support->delete();
        return back();
    }
}
