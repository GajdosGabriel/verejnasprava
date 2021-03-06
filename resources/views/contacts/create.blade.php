@extends('layouts.app')
@section('page-title', 'Nový kontakt')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <h1 class="page-title">Nový kontakt</h1>
        <form class="md:w-full text-sm" action="{{ route('contacts.store', $org->id) }}" method="POST">
            @csrf @method('POST')
            @include('modul.errors')
            @include('organizations._form')
        </form>

    </div>

    @endsection
