<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Council\Meeting;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $newComment;
    public $meeting;

    public function addComment(){
        $this->validate(['newComment' => 'required']);

        $meeting = Meeting::find(1);

        $meeting->comments()->create([
           'body' => $this->newComment,
           'name' => '$this->newComment',
//           'fileable_type' => 'App\Models\Council\Meeting',
//           'fileable_id' => 1,
           'user_id' => auth()->user()->id,
        ]);
      $this->newComment = '';
        session()->flash('message', 'Comentár uložený!');
    }

    public function delete($objectId){
        $comment= Comment::find($objectId);
        $comment->delete();

    }

    public function mount($meeting){
       $this->meeting = $meeting;
    }

    public function render()
    {
        return view('livewire.comments', ['comments' => $this->meeting->comments()->paginate(8)]);
//        return view('livewire.comments', ['comments' => Comment::latest()->paginate(8)]);
    }
}
