@extends('layouts.app')

@section('page-title', 'Upraviť návrh')

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
                                <input id="name" type="text" class="input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $item->name }}" required autocomplete="name" autofocus>
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
                            <div class="form-group row mt-5">
                                <label for="filename" class="col-md-4 col-form-label text-md-right">Prílohy k návrhu</label>

                                <div class="col-md-8">
                                    <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">

                                    {{--File--}}
                                    @if( $item->files->count())
                                        <div class="float-right">
                                        <h5>Príloha</h5>
                                        @forelse($item->files as $file)
                                            <a class="mr-2" target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}. Príloha</a>

                                            {{-- Check box --}}
                                            <div class="form-group form-check float-right">
                                                <input name="fileDelete[]" value="{{ $file->id }}" type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Zmazať</label>
                                            </div>
                                        @empty
                                            Bez prílohy
                                        @endforelse
                                        </div>

                                    @endif
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

                            <div class="form-group  float-right">
                                {{-- Return back button --}}
                                <a href="{{ url()->previous() }}" class="btn btn-light mx-4">Späť</a>

                                {{-- Save button --}}
                                <button type="submit" class="btn btn-primary">Uložiť</button>
                            </div>
                    </div>
                </div>
            </div>
        </form>




    @include('council.items._editor')
@endsection
