<div class="w-full">
    <h2 class="font-bold text-lg text-gray-700 mb-2 text-center">Odpoveď</h2>

    <form wire:submit.prevent="addComment">
        <div class="flex mb-5 max-w-sm">
            <input wire:model.lazy="newComment" type="text"
                   class="w-full border-2 border-gray-400 pl-3 rounded-l-g text-sm focus:outline-none"
                   placeholder="Napíšte podnet" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary rounded-r-lg text-sm" type="submit">Poslať</button>
        </div>
    </form>


    @forelse($question->comments as $comment)

{{--        Administrátor--}}
        <div class="bg-blue-100 p-3 mb-4 rounded shadow-lg">
            <div class="flex justify-between mb-3 items-center">
                <div class="flex">
                <img class="mr-5 rounded-full w-12" src="{{asset('image/administrator.jpg')}}" alt="...">
                <span class="self-center text-sm text-gray-800">Administrátor</span>
                </div>

                <span wire:click="delete({{ $comment->id }})" class="cursor-pointer text-gray-600">x</span>
            </div>
            <p>{{ $comment->body }}</p>

        </div>

    @empty
{{--        Bez záznamu.--}}
    @endforelse

    @error('newComment') <span class="error text-danger">{{ $message }}</span> @enderror


    {{ $comments->links('vendor.pagination.default') }}

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ Session::get('message') }}
        </div>
    @endif


</div>



