@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


        <h1>Založiť zastupiteľstvo</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('zast.item.store', [$meeting->id, $meeting->slug]) }}">
                            @csrf @method('POST')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Názov zastupiteľstva</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">Popis komisie</label>

                                <div class="col-md-8">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="name" autofocus>

                                    @error('description')
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
                        </form>

                     </div>

                    <div class="col-md-4">

                    </div>

{{--                    Aside part--}}
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>


@endsection
