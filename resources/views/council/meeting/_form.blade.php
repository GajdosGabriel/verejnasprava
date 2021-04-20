<div class="mb-4">
    <label for="name" class="text-gray-700 text-sm block">Vytvoriť novú schôdzu</label>
    <input id="name" type="text"
           class="@error('first_name') is-invalid @enderror"
           name="name" value="{{ old('name') ?? $meeting->name }}" placeholder="Názov schôdze" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="mb-4">
    <label for="locality" class="text-gray-700 text-sm block">Miesto schôdze</label>
    <input id="locality" type="text"
           class="form-control @error('locality') is-invalid @enderror"
           name="locality" value="{{ old('locality') ?? $meeting->locality }}" placeholder="nepovinné" autocomplete="name" autofocus>
    @error('locality')
    <span class="text-red-500 text-xs italic" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="">

    <div class="mb-4  sm:w-1/2 mr-4">
        <label for="start_at" class="block text-gray-700 text-sm mb-2">Dátum schôdze</label>

        {{--    Neviem vyriešiť podmienku ak datum chýba--}}
        @if($meeting->start_at == null)
            <div class="mb-4">
                <input type="datetime-local" name="start_at" value="{{ old('start_at') ?? $meeting->start_at }}"
                       id="start_at" class="input-control" required>
                @error('start_at')
                <span class="text-red-500 text-xs italic">
            <strong>{{ $message }}</strong>
        </span>
                @enderror
            </div>

        @else
            <div class="mb-4">
                <input type="datetime-local" name="start_at"
                       value="{{ old('start_at') ?? $meeting->start_at->format('Y-m-d\TH:i') }}" id="start_at"
                       class="input-control" required>
                @error('start_at')
                <span class="text-red-500 text-xs italic" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                @enderror
            </div>
        @endif

    </div>

    <div class="mb-4">
        <label for="first_name" class="block text-gray-700 font-semibold mb-2 text-sm">Prílohy pre schôdzu</label>
            <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha"
                   id="filename">

            @error('filename')
            <span class="text-red-500 text-xs italic" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
    </div>
</div>
{{-- Save button --}}
<div class="form-group mt-5">
    <button type="submit" class="btn btn-primary">Uložiť</button>
</div>
