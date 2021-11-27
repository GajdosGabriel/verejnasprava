@extends('layouts.app')
@section('page-title', 'Nové zastupiteľstvo')
    @section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Založiť zastupiteľstvo
            </x-slot>
        </x-page.page-title>

        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">
                <form method="POST" action="{{ route('organizations.councils.store', $organization->id) }}">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council._form')
                    @include('council._setup_form')

                    {{-- Save button --}}
                    <div class="flex justify-between my-4">
                        <a href="{{ URL::previous() }}"
                            class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
                        <button type="submit" class="btn btn-primary text-center">Uložiť</button>
                    </div>
                </form>

            </div>

            <div class="col-span-3 bg-white p-3">
                {{-- aside --}}
            </div>

        </x-page.page3_3>
    </x-page.container>


@endsection
