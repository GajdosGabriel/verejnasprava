@extends('layouts.app')
@section('page-title', 'Upraviť kontakt')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <h1>Upraviť dodávateľa</h1>

    <form action="{{ route('org.contact.update', [ $organization->id, $organization->slug]) }}" method="POST">
        @csrf @method('PUT')

        @include('organizations._form')

    </form>

    @endsection
