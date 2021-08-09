@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')

<x-page.container>
    <x-page.page-title>
        <x-slot name="title">
            Stránka sa nenašla
        </x-slot>

        <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
    </x-page.page-title>

    <h6>Ospravedlňujeme sa, niekde sa stala chyba 404</h6>
</x-page.container>

@endsection



