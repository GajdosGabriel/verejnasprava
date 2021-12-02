@extends('layouts.app')

@section('page-title', 'Stránka sa nenašla')


@section('navigation') <x-navigation.navPublic /> @endsection

@section('content')

<x-page.container>
    <x-page.page-title>
        <x-slot name="title">
            Stránka sa nenašla
        </x-slot>

        <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
    </x-page.page-title>

    <h6 class="mb-10">Ospravedlňujeme sa, niekde sa stala chyba 404</h6>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
</x-page.container>

@endsection



