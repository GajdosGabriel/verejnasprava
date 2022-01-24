<div class="">
    <h2 class="font-bold text-2xl text-gray-700 mb-2 text-center">Diskusia</h2>

    <form wire:submit.prevent="addComment">
        <div class="flex mb-5 max-w-sm">
            <input wire:model.lazy="newComment" type="text"
                   class="w-full border-2 border-gray-400 pl-3 rounded-l-g text-sm focus:outline-none"
                   placeholder="Napíšte príspevok" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary rounded-r-lg text-sm" type="submit">Poslať</button>
        </div>
    </form>


    @forelse($comments as $comment)
        <div class="mb-2">
            <div class="flex justify-between">
                <div>
                    <span class="text-sm text-gray-700 font-semibold">{{ $comment->user->full_name() }}</span>
                    <span class="text-sm text-gray-600 ">{{ $comment->created_at->diffForHumans() }}</span>
                </div>

                <span wire:click="delete({{ $comment->id }})" class="cursor-pointer text-gray-600">x</span>
            </div>
            {{ $comment->body }}

        </div>
    @empty
        Žiadne príspevky.
    @endforelse

    @error('newComment') <span class="error text-danger">{{ $message }}</span> @enderror


    {{ $comments->links('vendor.pagination.default') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ Session::get('message') }}
        </div>
    @endif


</div>


