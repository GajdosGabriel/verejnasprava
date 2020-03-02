@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <h1>Nový kontakt</h1>

    <form action="{{ route('org.contact.store', [ $org->id, $org->slug]) }}" method="POST">
        @csrf @method('POST')

        @include('organizations._form')

    </form>

    @endsection