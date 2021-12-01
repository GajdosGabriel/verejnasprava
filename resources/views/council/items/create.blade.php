@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

@section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový návrh
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>

        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">

                <form method="POST" action="{{ route('items.store') }}" class=""
                    enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council.items._form')
                </form>
            </div>

            <div class="col-span-3 bg-white p-3">
                {{-- Aside --}}
            </div>
        </x-page.page3_3>
        @include('council.items._editor')

    </x-page.container>
@endsection
