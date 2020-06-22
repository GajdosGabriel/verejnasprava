@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

@section('navigation')
    <x-navigationItems/> @endsection

{{--@section('navigation')--}}
{{--    @include('council.items.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <h1 class="page-title">Nový bod programu</h1>

        <form method="POST" action="{{ route('item.store', [$meeting->id, $meeting->slug]) }}"
              enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errorsAndFlash')
            <div class="">
                <div class="">
                    <div class="flex w-full">

                        {{--  title--}}
                        <div class="form-group">
                            <label for="name" class="font-semibold">Bod programu</label>
                            <div class="">
                                <input id="name" type="text"
                                       class="input-control focus:outline-none focus:shadow-outline @error('first_name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group px-10">
                            <label for="vote_type" class="font-semibold">Hlasovanie</label>

                            <div class="">
                                <select name="vote_type" class="custom-select" id="vote_type">
                                    <option value="0">Verejné</option>
                                    <option value="1">Tajné</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="my-5">
                            <label class="font-semibold">Popis návrhu</label>

                            <div class="col-md-8">
                                <textarea id="editor" class="form-control" name="description" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="md:flex justify-between my-5">

                            {{--Príloha--}}
                            <div class="form-group">
                                <label for="filename" class="font-semibold">Prílohy k návrhu</label>

                                <div class="">
                                    <input type="file" name="filename[]" value="{{ old('filename') }}" multiple
                                           placeholder="Príloha" id="filename">
                                </div>
                            </div>



                        </div>


                        <div class="flex justify-between mt-6">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Späť</a>
                            <button type="submit" class="btn btn-primary">Uložiť</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @include('council.items._editor')

    </div>
@endsection
