@role('admin')
<section class="p-2 bg-gray-200 mb-4 rounded-md">
    <h1 class="font-medium text-lg">{{ $user->full_name() }} nálepka:</h1>

    <div class="md:flex w-full">

        {{-- Section Tags --}}
        <div class="flex flex-wrap">
            @forelse($organization->tags as $tag)
                <div class="mr-4 mb-2 {{ $errors->has('tag') ? ' has-error' : '' }}">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="tag[]" type="checkbox" id="tag"
                               value="{{ $tag->id }}"
                               @if($tag->users->contains($user->id) ) checked @endif
                        >
                        <label class="input-label" for="tag">{{ $tag->name }}</label>

                    </div>
                </div>
            @empty
               Žiadne skupiny.
            @endforelse
        </div>

    </div>
</section>
@endrole
