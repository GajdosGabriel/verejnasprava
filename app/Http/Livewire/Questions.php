<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Council\Meeting;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Questions extends Component
{
    use WithPagination;

    public $newComment;
    public $question;

    public function addComment($question){
        $this->validate(['newComment' => 'required']);

        $question = Question::find($this->question->id);

        $question->comments()->create([
            'body' => $this->newComment,
            'name' => '$this->newComment',
            'user_id' => auth()->user()->id,
        ]);
        $this->newComment = '';
//        session()->flash('message', 'Comentár uložený!');
    }

    public function delete($objectId){
        $comment= Comment::find($objectId);
        $comment->delete();
    }

    public function mount($question){
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.questions', ['comments' => $this->question->comments()->latest()->paginate(8)]);
//        return view('livewire.comments', ['comments' => Comment::latest()->paginate(8)]);
    }
}
