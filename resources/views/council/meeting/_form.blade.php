
<div class="mb-4">
    <label for="name" class="block text-gray-700 text-sm mb-2">Zvolanie zastupiteľstva</label>
    <input id="name" type="text" class="hadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $meeting->name }}" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-4">
    <label for="first_name" class="block text-gray-700 text-sm mb-2">Popis schôdze</label>
    <input id="description" type="text" class="hadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $meeting->description }}" autocomplete="name" autofocus>
    @error('description')
    <span class="text-red-500 text-xs italic" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-4">
    <label for="first_name" class="block text-gray-700 text-sm mb-2">Dátum schôdze</label>

{{--    Neviem vyriešiť podmienku ak datum chýba--}}
    @if($meeting->start_at == null)
        <div class="mb-4">
            <input type="datetime-local" name="start_at" value="{{ old('start_at') ?? $meeting->start_at }}" id="start_at" class="form-control" required>
            @error('start_at')
            <span class="text-red-500 text-xs italic">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

    @else
    <div class="mb-4">
        <input type="datetime-local" name="start_at" value="{{ old('start_at') ?? $meeting->start_at->format('Y-m-d\TH:i') }}" id="start_at" class="form-control" required>
        @error('start_at')
        <span class="text-red-500 text-xs italic" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif

</div>

<div class="mb-4">
    <label for="first_name" class="block text-gray-700 text-sm mb-2">Prílohy pre schôdzu</label>
    <div class="col-md-8">
        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">

        @error('filename')
            <span class="text-red-500 text-xs italic" role="alert">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- Save button --}}
<div class="form-group">
    <button type="submit" class="btn btn-blue">Uložiť</button>
</div>
