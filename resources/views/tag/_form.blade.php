
<div class="my-3">
    <label for="name" class="input-label">Nová skupina</label>

    <div class="col-md-8">
        <input id="tag" type="text" class="input-control focus:outline-none focus:shadow-outline @error('tag') is-invalid @enderror" name="name"
{{--               value="{{ old('tag') ?? $tag->name }}" --}}
               required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


