@extends('layouts.app')

@section('page-title', 'Upraviť návrh')

    @section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Úprava návrhu na uznesenie
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        <form method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('modul.errors')
            <div class="">
                <div class="">

                    <div class="flex justify-between">

                        <div class="lg:w-3/4">
                            <label for="name" class="font-semibold">Bod programu</label>
                            <input id="name" type="text"
                                class="w-full input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror"
                                name="name" value="{{ old('name') ?? $item->name }}" required autocomplete="name"
                                autofocus>
                        </div>


                        <div class="form-group w-1/4 mx-5">
                            <label for="vote_typ" class="font-semibold">Hlasovanie</label>

                            <div class="">
                                <select name="vote_type" class="custom-select" id="vote_typ">
                                    <option value="0" @if ($item->vote_type == 0) selected @endif>Verejné
                                    </option>
                                    <option value="1" @if ($item->vote_type == 1) selected @endif>Tajné
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="font-semibold">Popis návrhu</label>

                        <div class="col-md-8">
                            <textarea id="editor" class="form-control" name="body" rows="10">{{ $item->body }}</textarea>
                        </div>
                    </div>

                    {{-- Príloha --}}
                    <div class="form-group row mt-5">
                        <label for="filename" class="font-semibold">Prílohy k návrhu</label>

                        <div class="col-md-8">
                            <input type="file" name="filename[]" value="{{ old('filename') }}" multiple
                                placeholder="Príloha" id="filename">

                            {{-- File --}}
                            @if ($item->files->count())
                                <div class="flex float-right">
                                    {{-- <h5>Príloha</h5> --}}
                                    @forelse($item->files as $file)
                                        <div class="hover:bg-gray-200 p-3">
                                            <a class="mr-2" target="_blank"
                                                href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}
                                                . Príloha
                                            </a>

                                            {{-- Check box --}}
                                            <div class="mr-4">
                                                <input name="fileDelete[]" value="{{ $file->id }}" type="checkbox"
                                                    class="" id="exampleCheck1">
                                                <label class="" for="exampleCheck1">Zmazať</label>
                                            </div>
                                        </div>
                                    @empty
                                        Bez prílohy
                                    @endforelse
                                </div>

                            @endif
                        </div>
                    </div>


                    <div class="flex justify-between mt-16">
                        {{-- Return back button --}}
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Späť</a>

                        {{-- Save button --}}
                        <button type="submit" class="btn btn-primary">Uložiť</button>
                    </div>

                </div>
            </div>
        </form>


    </x-page.container>


    @include('council.items._editor')
@endsection
