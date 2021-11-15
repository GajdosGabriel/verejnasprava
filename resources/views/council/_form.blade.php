
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
    <label for="description" class="input-label">Popis zastupiteľstva</label>

    <div class="col-md-8">
        <input id="description" type="text" class="w-full @error('body') is-invalid @enderror" name="description" value="{{ old('description') ?? $council->description  }}" autocomplete="description">

        @error('description')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

