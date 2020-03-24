@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


        <h1>Nový bod programu</h1>

        <form method="POST" action="{{ route('item.store', [$meeting->id, $meeting->slug]) }}">
            @csrf @method('POST')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-header">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Bod programu</label>

                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">Popis návrhu</label>

                                        <div class="col-md-8">
                                            <textarea id="description" class="form-control" name="description"></textarea>
                                        </div>
                                    </div>

                                    {{-- Save button --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary float-right">Uložiť</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>


@endsection
