
<div class="my-3">
    <label for="name" class="input-label">Názov zastupiteľstva</label>

    <div class="col-md-8">
        <input id="name" type="text" class="w-full @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $council->name }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="my-3">
    <label for="body" class="input-label">Popis zastupiteľstva</label>

    <div class="col-md-8">
        <input id="body" type="text" class="w-full @error('body') is-invalid @enderror" name="body" value="{{ old('body') ?? $council->body  }}" autocomplete="body">

        @error('body')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

