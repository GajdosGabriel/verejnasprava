@extends('layouts.app')
@section('page-title', 'Upraviť kontakt')

@section('navigation') @include('organizations.navigation') @endsection
{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
<x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Upraviť dodávateľa
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>


    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
        @csrf @method('PUT')

        @include('organizations._form')

    </form>
</x-page.container>
    @endsection
