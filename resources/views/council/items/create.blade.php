@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')


        <h1>Nový bod programu</h1>

        <form method="POST" action="{{ route('item.store', [$meeting->id, $meeting->slug]) }}" enctype="multipart/form-data">
            @csrf @method('POST')

            <div class="col-md-12">
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
                                <label class="col-md-4 col-form-label text-md-right">Popis návrhu</label>

                                <div class="col-md-8">
                                    <textarea id="editor" class="form-control" name="description" rows="10"></textarea>
                                </div>
                            </div>

                            {{--Príloha--}}
                            <div class="form-group row">
                                <label for="filename" class="col-md-4 col-form-label text-md-right">Prílohy k návrhu</label>

                                <div class="col-md-8">
                                    <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vote_type" class="col-md-4 col-form-label text-md-right">Hlasovanie</label>

                                <div class="col-md-8">
                                    <select name="vote_type" class="custom-select" id="vote_type">
                                        <option value="0">Verejné</option>
                                        <option value="1">Tajné</option>
                                    </select>
                                </div>
                            </div>



                            {{-- Save button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Uložiť</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>

    @include('council.items._editor')
@endsection
