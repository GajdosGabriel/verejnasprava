@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový návrh programu
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>

        <form method="POST" action="{{ route('items.store') }}" class="" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('council.items._form')
        </form>

        @include('council.items._editor')

    </x-page.container>
@endsection
