<?php

namespace App\Http\Controllers;


use App\Models\Question;
use App\Notifications\Questions;
use Illuminate\Support\Facades\Validator;
use App\Models\Support;
use Illuminate\Http\Request;

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

        $support->user->notify(new Questions($support));

        return back();
    }

    public function store(Request $request) {

      auth()->user()->supports()->create($request->all());

//        $question->user->notify(new Questions($question));
//        $question->user->find(1)->notify(new Questions($question));

//        flash()->success('Správa bola odoslaná');


        return redirect()->back();

    }

    public function destroy(Support $support){
        $this->authorize('delete', $support);

        $support->delete();
        return back();
    }
}
