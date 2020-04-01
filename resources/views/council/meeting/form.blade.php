
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Zvolanie zastupiteľstva</label>

    <div class="col-md-8">
        <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $meeting->name }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="first_name" class="col-md-4 col-form-label text-md-right">Popis schôdze</label>

    <div class="col-md-8">
        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $meeting->description }}" required autocomplete="name" autofocus>

        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="first_name" class="col-md-4 col-form-label text-md-right">Dátum schôdze</label>

{{--    Neviem vyriešiť podmienku ak datum chýba--}}
    @if($meeting->start_at == null)
        <div class="col-md-8">
            <input type="datetime-local" name="start_at" value="{{ old('start_at') ?? $meeting->start_at }}" id="start_at" class="form-control" required>
            @error('start_at')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

    @else
    <div class="col-md-8">
        <input type="datetime-local" name="start_at" value="{{ old('start_at') ?? $meeting->start_at->format('Y-m-d\TH:i') }}" id="start_at" class="form-control" required>
        @error('start_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif

</div>

<div class="form-group row">
    <label for="filename" class="col-md-4 col-form-label text-md-right">Prílohy pre schôdzu</label>

    <div class="col-md-8">
        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">

        @error('filename')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

{{-- Save button --}}
<div class="form-group">
    <button type="submit" class="btn btn-primary float-right">Uložiť</button>
</div>
