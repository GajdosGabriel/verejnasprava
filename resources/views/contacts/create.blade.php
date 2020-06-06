@extends('layouts.app')
@section('page-title', 'Nový kontakt')

@section('navigation') <x-navigationOrganization /> @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <h1 class="page-title">Nový kontakt</h1>
        <form class="md:w-full" action="{{ route('org.contact.store', [ $org->id, $org->slug]) }}" method="POST">
            @csrf @method('POST')
            @include('organizations._form')
        </form>

    </div>

    @endsection
