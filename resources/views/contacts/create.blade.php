@extends('layouts.app')
@section('page-title', 'Nový kontakt')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

<x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový kontakt
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>

        <form class="md:w-full text-sm" action="{{ route('contacts.store', $org->id) }}" method="POST">
            @csrf @method('POST')
            @include('modul.errors')
            @include('organizations._form')
        </form>

    </x-page.container>

    @endsection
