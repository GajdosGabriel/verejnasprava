@extends('layouts.app')

@section('page-title', 'Upraviť návrh')

@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">
        <h1 class="page-title">Uprava návrhu</h1>

        <form method="POST" action="{{ route('item.update', [$item->id, $item->slug]) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="">
                <div class="">

                    <div class="flex justify-between">

                            <div class="lg:w-3/4">
                                <label for="name" class="font-semibold">Bod programu</label>
                                <input id="name" type="text" class="w-full input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror" name="name" value="{{ old('name') ?? $item->name }}" required autocomplete="name" autofocus>
                            </div>


                            <div class="form-group w-1/4 mx-5">
                                <label for="vote_typ" class="font-semibold">Hlasovanie</label>

                                <div class="">
                                    <select name="vote_type" class="custom-select" id="vote_typ">
                                        <option value="0"
                                                @if($item->vote_type == 0) selected @endif
                                        >Verejné</option>
                                        <option value="1"
                                                @if($item->vote_type == 1) selected @endif
                                        >Tajné</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="font-semibold">Popis návrhu</label>

                            <div class="col-md-8">
                                <textarea id="editor" class="form-control" name="description" rows="10">{{ $item->description }}</textarea>
                            </div>
                        </div>

                            {{--Príloha--}}
                            <div class="form-group row mt-5">
                                <label for="filename" class="font-semibold">Prílohy k návrhu</label>

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




                            <div class="flex justify-between mt-5">
                                {{-- Return back button --}}
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Späť</a>

                                {{-- Save button --}}
                                <button type="submit" class="btn btn-primary">Uložiť</button>
                            </div>

                </div>
            </div>
        </form>


    </div>


    @include('council.items._editor')
@endsection
