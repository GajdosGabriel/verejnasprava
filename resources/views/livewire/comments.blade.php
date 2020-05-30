<div>
     <h2 class="font-bold text-2xl text-gray-700 mb-2">Pripomienky</h2>

    <form wire:submit.prevent="addComment">
        <div class="flex">
            <input wire:model.lazy="newComment" type="text" class="w-full border-2 border-gray-400 p-2 rounded-l-lg" placeholder="Napíšte podnet" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary rounded-r-lg" type="submit" >Poslať</button>
        </div>
    </form>


        @forelse($comments as $comment)
           <div class="mb-2">
               <div class="d-flex justify-content-between">
                   <span class="text-gray-600 text-sm ">{{ $comment->user->full_name() }}</span>
                   <small>{{ $comment->created_at->diffForHumans() }}</small>
               </div>
               {{ $comment->body }}
               <span style="cursor: pointer" wire:click="delete({{ $comment->id }})" class="float-right">x</span>
            </div>
            @empty
            Bez záznamu.
        @endforelse

    @error('newComment') <span class="error text-danger">{{ $message }}</span> @enderror


    {{ $comments->links('vendor.pagination.default') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert" id="success-alert">
           {{ Session::get('message') }}
        </div>
    @endif


</div>


