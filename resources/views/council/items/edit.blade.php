@extends('layouts.app')



@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')


        <h1>Uprava návrhu</h1>

        <form method="POST" action="{{ route('item.update', [$item->id, $item->slug]) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Bod programu</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $item->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Popis návrhu</label>

                                <div class="col-md-8">
                                    <textarea id="editor" class="form-control" name="description" rows="10">{{ $item->description }}</textarea>
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
                                <label for="vote_typ" class="col-md-4 col-form-label text-md-right">Hlasovanie</label>

                                <div class="col-md-8">
                                    <select name="vote_type" class="custom-select" id="vote_typ">
                                        <option value="1"
                                        @if($item->vote_type == 1) selected @endif
                                        >Verejné</option>
                                        <option value="0"
                                                @if($item->vote_type == 0) selected @endif
                                        >Tajné</option>
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
