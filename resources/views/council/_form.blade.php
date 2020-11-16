
<div class="my-3">
    <label for="name" class="input-label">Názov zastupiteľstva</label>

    <div class="col-md-8">
        <input id="name" type="text" class="input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $council->name }}" required autocomplete="name" autofocus>
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
        <input id="description" type="text" class="input-control focus:outline-none focus:shadow-outline @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $council->description  }}" autocomplete="description">

        @error('description')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

{{-- Save button --}}
<div class="flex justify-between my-4">
    <a href="{{ URL::previous() }}" class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
    <button type="submit"  class="btn btn-primary text-center">Uložiť</button>
</div>

