<?php

namespace App\Http\Controllers;

use App\Notifications\Questions;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class QuestionsController extends Controller
{

    public function index() {

        $questions = Question::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('questions.index')->with('questions', $questions);

    }
    public function store(Request $request) {

//        return $request->all();

        $validator = Validator::make ($request->all(),[
            'question' => 'required|min:3'
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

       $question =  \Auth::user()->questions()->create($request->all());

//        $question->user->notify(new Questions($question));
//        $question->user->find(1)->notify(new Questions($question));

//        flash()->success('Správa bola odoslaná');

//        return $validator;
        return redirect()->back();

    }
}
