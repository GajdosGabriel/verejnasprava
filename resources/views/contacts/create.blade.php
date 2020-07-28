@extends('layouts.app')
@section('page-title', 'Nový kontakt')

@section('navigation') <x-navigation.navigationOrganization /> @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <h1 class="page-title">Nový kontakt</h1>
        <form class="md:w-full text-sm" action="{{ route('contact.store', $org->id) }}" method="POST">
            @csrf @method('POST')
            @include('modul.errorsAndFlash')
            @include('organizations._form')
        </form>

    </div>

    @endsection
