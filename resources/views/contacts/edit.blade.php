@extends('layouts.app')
@section('page-title', 'Upraviť kontakt')

@section('navigation') <x-navigationOrganization /> @endsection
{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container mx-auto min-h-screen p-6">

    <h1 class="font-bold text-2xl">Upraviť dodávateľa</h1>

    <form action="{{ route('org.contact.update', [ $organization->id, $organization->slug]) }}" method="POST">
        @csrf @method('PUT')

        @include('organizations._form')

    </form>
    </div>
    @endsection
