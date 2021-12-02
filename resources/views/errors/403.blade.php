@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')
<x-page.container>
    <x-page.page-title>
        <x-slot name="title">
            Nie ste autorizovaný
        </x-slot>

        <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
    </x-page.page-title>

    <h6 class="mb-10">Kód chyby 403</h6>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
</x-page.container>

@endsection
