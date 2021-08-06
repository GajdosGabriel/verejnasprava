@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') --}}
{{-- @include('organizations.navigation') --}}
{{-- @endsection --}}

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Členovia výboru: {{ $council->name }}
            </x-slot>

            <a class="btn btn-primary text-center" href="{{ route('user.create', [$council->id, $council->slug]) }}">Nový
                člen</a>
        </x-page.page-title>


        @include('user._userTable')

    </x-page.container>

@endsection
