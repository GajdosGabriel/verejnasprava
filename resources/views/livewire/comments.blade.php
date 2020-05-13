<div>
     <h4>Pripomienky</h4>
    <form wire:submit.prevent="addComment">
        <div class="input-group mb-3">
            <input wire:model.lazy="newComment" type="text" class="form-control" placeholder="Napíšte podnet" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Poslať</button>
            </div>
        </div>
    </form>


        @forelse($comments as $comment)
           <div class="mb-2">
               <div class="d-flex justify-content-between">
                   <strong>{{ $comment->user->full_name() }}</strong>
                   <small>{{ $comment->created_at->diffForHumans() }}</small>
               </div>
               {{ $comment->body }}
               <span style="cursor: pointer" wire:click="delete({{ $comment->id }})" class="float-right">x</span>
            </div>
            @empty
            Bez záznamu.
        @endforelse

    @error('newComment') <span class="error text-danger">{{ $message }}</span> @enderror


    {{ $comments->links() }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert" id="success-alert">
           {{ Session::get('message') }}
        </div>
    @endif


</div>


