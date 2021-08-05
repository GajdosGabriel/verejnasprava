@extends('layouts.app')
@section('page-title', 'Nový kontakt')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">

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

    </div>

    @endsection
