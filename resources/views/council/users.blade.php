@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <x-page.page-title>
            <x-slot name="title">
                Členovia výboru: {{ $council->name }}
            </x-slot>

            <a class="btn btn-primary text-center" href="{{ route('user.create', [$council->id, $council->slug]) }}">Nový člen</a>
        </x-page.page-title>


    @include('user._userTable')

    </div>

@endsection
