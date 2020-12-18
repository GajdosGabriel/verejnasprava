@role('admin')
<div class="p-2 bg-gray-200 mb-4 rounded-md">
    <h1 class="font-medium text-lg">{{ $user->full_name() }} nálepka:</h1>

    <div class="md:flex w-full">

        {{-- Section Tags --}}
        <div class="sm:w-1/2">

            @forelse($organization->tags as $tag)
                <div class="form-group {{ $errors->has('tag') ? ' has-error' : '' }}">
                    <label class="col-form-label"></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="council[]" type="checkbox" id="council"
                               value="{{ $tag->id }}"
                               @if($tag->users->contains($user->id) ) checked @endif
                        >
                        <label class="input-label" for="council">{{ $tag->name }}</label>

                    </div>
                </div>
            @empty
               Žiadne skupiny.
            @endforelse
        </div>

    </div>
</div>
@endrole
