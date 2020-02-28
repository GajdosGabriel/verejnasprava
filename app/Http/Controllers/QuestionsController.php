<?php

namespace App\Http\Controllers;

use App\Notifications\Questions;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class QuestionsController extends Controller
{

    public function index() {

        $questions = Question::orderBy('created_at', 'desc')->paginate(8);
////        only for me
//        if ($user->role == 'admin') {
//            $questions = Question::orderBy('created_at', 'desc')->paginate(8);
//        } else {
//            //        for all others
//            $questions = Question::where("user_id", "=", $user->id)->orderBy('id', 'DESC')->paginate(8);
//        }

        return view('questions.index')->with('questions', $questions);

    }
    public function store(Request $request) {

        return $request->all();

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

        return $validator;
        return redirect()->back();

    }
}
