@extends('layouts.app')
@section('page-title', 'Upraviť kontakt')

@section('navigation') <x-navigation.navigationOrganization /> @endsection
{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container mx-auto min-h-screen p-6">

    <h1 class="page-title">Upraviť dodávateľa</h1>

    <form action="{{ route('contact.update', $organization->id) }}" method="POST">
        @csrf @method('PUT')

        @include('organizations._form')

    </form>
    </div>
    @endsection
